<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mail
 *
 * @ORM\Table(name="mail")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MailRepository")
 */
class Mail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=255)
     */
    private $sender;

    /**
     * @var array
     *
     * @ORM\Column(name="receivers", type="array")
     */
    private $receivers;
    
    /**
     * @var array
     *
     * @ORM\Column(name="attachments", type="array", nullable=true)
     */
    private $attachments;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;
    
    /**
     * @var bool|null
     *
     * @ORM\Column(name="isSent", type="boolean", nullable=true)
     */
    private $isSent;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return Mail
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body.
     *
     * @param string|null $body
     *
     * @return Mail
     */
    public function setBody($body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string|null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set sender.
     *
     * @param string $sender
     *
     * @return Mail
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender.
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receivers.
     *
     * @param array $receivers
     *
     * @return Mail
     */
    public function setReceivers($receivers)
    {
        $this->receivers = $receivers;

        return $this;
    }

    /**
     * Get receivers.
     *
     * @return array
     */
    public function getReceivers()
    {
        return $this->receivers;
    }
    
    /**
     * Set attachments.
     *
     * @param array|null $attachments
     *
     * @return Mail
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Get attachments.
     *
     * @return array|null
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set isSent.
     *
     * @param bool|null $isSent
     *
     * @return Mail
     */
    public function setIsSent($isSent = null)
    {
        $this->isSent = $isSent;

        return $this;
    }

    /**
     * Get isSent.
     *
     * @return bool|null
     */
    public function getIsSent()
    {
        return $this->isSent;
    }
    
    /**
     * Set priority.
     *
     * @param int|null $priority
     *
     * @return Mail
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority.
     *
     * @return int|null
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
