<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Mail;

class MailController extends FOSRestController {

    /**
     * @Rest\Get("/mails")
     */
    public function getAllMailsAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Mail')->findAll();
        if ($restresult === null) {
            return new View("there are no mails", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/mails/{id}")
     */
    public function getMailAction($id) {
        $mail = $this->getDoctrine()->getRepository('AppBundle:Mail')->find($id);
        if ($mail === null) {
            return new View("mail not found", Response::HTTP_NOT_FOUND);
        }
        return $mail;
    }

    /**
     * @Rest\Post("/mails/")
     */
    public function postMailAction(Request $request) {
        $data = new Mail;
        $title = $request->get('title');
        $body = $request->get('body');
        $sender = $request->get('sender');
        $receivers = is_array($request->get('receivers')) ? $request->get('receivers') : [$request->get('receivers')];
        if (empty($sender) || empty($receivers)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $files = $request->files->get('attachments', []);
        $path = $this->get('kernel')->getRootDir() . '/attachments';
        $attachments = [];
        foreach ($files as $file) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($path, $fileName);
            $attachments[$fileName] = $file->getClientOriginalName();
        }
        $priority = $request->get('priority');
        if (!empty($priority) && ($priority < 1 || $priority > 5)) {
            return new View("ONLY VALUES BETWEEN 1 AND 5 ARE ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        if (empty($priority)) {
            $priority = \Swift_Mime_SimpleMessage::PRIORITY_NORMAL;
        }
        $isSent = $request->get('isSent');
        $data->setTitle($title);
        $data->setBody($body);
        $data->setSender($sender);
        $data->setReceivers($receivers);
        $data->setAttachments($attachments);
        $data->setPriority($priority);
        $data->setIsSent($isSent);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Mail Added Successfully", Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/send-mails")
     */
    public function sendMailsAction() {
        $mails = $this->getDoctrine()->getRepository('AppBundle:Mail')->findAllNotSentMails();
        $path = $this->get('kernel')->getRootDir() . '/attachments/';
        foreach ($mails as $mail) {
            $title = $mail->getTitle();
            $from = $mail->getSender();
            $to = $mail->getReceivers();
            $body = $mail->getBody();
            $attachments = $mail->getAttachments() ? $mail->getAttachments() : [];
            $priority = $mail->getPriority();
            $mailer = $this->get('mailer');
            $this->sendMessage($mailer, $title, $from, $to, $body, $priority, $attachments, $path);
            $mail->setIsSent(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();
        }
        return new View("Mails Added To Spool Successfully", Response::HTTP_OK);
    }

    public function sendMessage(\Swift_Mailer $mailer, $title, $from, $to, $body, $priority, $attachments, $path) {
        $message = \Swift_Message::newInstance($title)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body)
                ->setPriority($priority);
        foreach ($attachments as $key => $attachment) {
            $message->attach(
                    \Swift_Attachment::fromPath($path . $key)->setFilename($attachment)
            );
        }

        $mailer->send($message); // pushes the message to the spool queue
    }

}
