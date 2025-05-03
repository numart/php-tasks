<?php

namespace Numa\Tasks\Tasks;

use JsonSerializable;

/**
 * A Task Object
 */
class Task implements JsonSerializable
{

    const STATUS_COMPLETE = 2;

    const STATUS_PROGRESS = 1;

    const array STATUS = [
      0 => 'inbox',
      1 => 'In progress',
      2 => 'Done',
    ];

    public function __construct(
      protected int $id,
      protected string $title,
      protected string $description = '',
      protected ?int $completeAt = null,
      protected int $create = 0,
      protected int $update = 0,
      protected int $status = 0,
    ) {
        $this->create = $this->create ?: time();
        $this->update = $this->update ?: time();
    }

    public function getCompleteAt(): int
    {
        return $this->completeAt;
    }

    public function setCompleteAt(int $completeAt): Task
    {
        $this->completeAt = $completeAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  mixed  $id
     *
     * @return Task
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  mixed  $title
     *
     * @return Task
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCreate(): string
    {
        return $this->create;
    }

    /**
     * @param  string  $create
     *
     * @return $this
     */
    public function setCreate(string $create): Task
    {
        $this->create = $create;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdate(): string
    {
        return $this->update;
    }

    /**
     * @param  int  $update
     *
     * @return $this
     */
    public function setUpdate(int $update): Task
    {
        $this->update = $update;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param  mixed  $status
     *
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): object
    {
        return (object)get_object_vars($this);
    }

    public function setCompleted(bool $complete): void
    {
        if ($complete) {
            $this->setStatus(self::STATUS_COMPLETE);
            $this->completeAt = time();
        } else {
            $this->setStatus(self::STATUS_PROGRESS);
            $this->completeAt = 0;
        }
        $this->setUpdate(time());
    }

}