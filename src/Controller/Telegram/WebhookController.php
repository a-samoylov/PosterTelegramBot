<?php

namespace App\Controller\Telegram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WebhookController extends AbstractController
{
    // ########################################

    /**
     * Endpoint Telegram webhook
     *
     * @Route("/telegram/webhook/{accessKey}", name="telegram_controller")
     *
     * @param string                                   $accessKey
     * @param \App\Telegram\Auth\Checker               $telegramAuthChecker
     * @param \App\Command\Processor                   $telegramCommandProcessor
     * @param \App\Telegram\Model\Type\Update\Resolver $updateResolver
     * @param \App\Repository\Telegram\BotRepository   $botRepository
     * @param \Psr\Log\LoggerInterface                 $logger
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        string                                   $accessKey,
        \App\Telegram\Auth\Checker               $telegramAuthChecker,
        \App\Command\Processor                   $telegramCommandProcessor,
        \App\Telegram\Model\Type\Update\Resolver $updateResolver,
        \App\Repository\Telegram\BotRepository   $botRepository,
        \Psr\Log\LoggerInterface                 $logger
    ) {
        $request  = Request::createFromGlobals();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        if (!$telegramAuthChecker->isValidAccessKey($accessKey)) {
            $logger->alert('Invalid access token.', [
                '_SERVER'     => $_SERVER,
                '_POST'       => $_POST,
                'access_key'  => $accessKey,
                'php://input' => $request->getContent(),
            ]);

            $response->setContent(json_encode(['message' => 'Invalid access data.']));
            $response->setStatusCode(Response::HTTP_FORBIDDEN);

            return $response;
        }

        try {
            $data   = (array)json_decode($request->getContent(), true);//php://input
            $update = $updateResolver->resolve($data);
            if (is_null($update)) {
                $logger->alert('Update not recognize.', [
                    'data' => $data
                ]);
                $response->setContent(json_encode(['message' => 'Error input data.']));
                $response->setStatusCode(Response::HTTP_FORBIDDEN);

                return $response;
            }

        } catch (\App\Model\Exception\Validate $validateException) {
            $logger->alert('Error input data.', [
                'input_data' => $validateException->getInputData(),
                'field_name' => $validateException->getFieldName(),
                'class_name' => $validateException->getClassName(),
                'message'    => $validateException->getMessage(),
                'code'       => $validateException->getCode(),
            ]);

            $response->setContent(json_encode(['message' => 'Error input data.']));
            $response->setStatusCode(Response::HTTP_FORBIDDEN);

            return $response;
        }

        /** @var \App\Command\Response $commandResponse */
        $commandResponse = $telegramCommandProcessor->process($botRepository->findOneBy(['accessKey' => $accessKey]), $update);
        if (!$commandResponse->isSuccess()) {
            $response->setContent(json_encode(['message' => $commandResponse->getMessage()]));
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $response;
        }

        $response->setContent(json_encode(['message' => $commandResponse->getMessage()]));
        $response->setStatusCode(Response::HTTP_OK);

        //dump($request);
        return $response;
    }

    // ########################################
}
