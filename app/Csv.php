<?php

namespace App;

class Csv
{
  private $csv = [];
  private $rates = 0;
  private $taxes = 0;
  private $total = 0;

  public function printTable(): void
  {
    include('../app/views/table.php');
  }

  public function setFile(array $file): void
  {
    $this->csv = array_map('str_getcsv', file($file['tmp_name']));
  }

  public function computeTotals(): void
  {
    foreach($this->csv as $row) {
      $this->taxes += (int) $row[4];
      $this->rates += (int) $row[3];
      $this->total += (int) $row[3] + (int) $row[4];
    }

    array_push($this->csv, ['', '', 'Subtotal', $this->rates, $this->taxes]);
    array_push($this->csv, ['', '', 'Total', $this->total, '']);
  }
}