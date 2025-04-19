<?php

namespace Numa\Tasks\Tasks;

use JsonSerializable;

/**
 * A Task Object
 */
class Task implements JsonSerializable
{

    const array STATUS = [
      0 => 'inbox',
      1 => 'In progress',
      2 => 'Done',
    ];

    public function __construct(
      protected int $id,
      protected string $title,
      protected string $date,
      protected int $status,
    ) {}

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
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param  mixed  $date
     *
     * @return Task
     */
    public function setDate($date)
    {
        $this->date = $date;
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

    public function jsonSerialize(): object
    {
        return (object)get_object_vars($this);
    }

}