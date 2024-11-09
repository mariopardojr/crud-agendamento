<?php
class Customer
{
  public string $id;
  public string $name;
  public string $time;
  public string $date;

  public function __construct($id, $name, $time, $date)
  {
      $this->id = $id;
      $this->name = $name;
      $this->time = $time;
      $this->date = $date;
  }

  public function getFormattedTime(): string
  {
      return "{$this->time}:00";
  }

  public function update($name, $time, $date) {
    $name && $this->name = $name;
    $time && $this->time = $time;
    $date && $this->date = $date;
  }

  public function createJsObject() {
    return "{ id: {$this->id}, name:'{$this->name}', time: {$this->time}, date: '{$this->date}' }";
  }
}