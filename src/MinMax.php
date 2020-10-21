<?php

namespace Trevos;

/**
 * Class MinMax
 * @package Trevos
 */
class MinMax
{
    private $matrix;
    private $x;
    private $y;
    private $minimum;
    private $maximum;
    private $minimumValues = [];
    private $maximumValues = [];
    private $maximalRandomNumber = 1000;

    public function generateMatrix()
    {
        for ($y = 1; $y <= $this->y; $y++) {
            for ($x = 1; $x <= $this->x; $x++) {
                $this->matrix[$x][$y] = rand(0, $this->maximalRandomNumber);
            }
        }

        $this->findMinimumAndMaximum();
    }

    private function findMinimumAndMaximum()
    {
        $this->minimum = $this->maximum = $this->matrix[1][1];

        for ($y = 1; $y <= $this->y; $y++) {
            for ($x = 1; $x <= $this->x; $x++) {
                if ($this->matrix[$x][$y] == $this->minimum) {
                    $this->minimumValues[] = [$x, $y];
                }

                if ($this->matrix[$x][$y] == $this->maximum) {
                    $this->maximumValues[] = [$x, $y];
                }
                if ($this->matrix[$x][$y] > $this->maximum) {
                    $this->maximumValues = [];
                    $this->maximumValues[] = [$x, $y];
                    $this->maximum = $this->matrix[$x][$y];
                } elseif ($this->matrix[$x][$y] < $this->minimum) {
                    $this->minimumValues = [];
                    $this->minimumValues[] = [$x, $y];
                    $this->minimum = $this->matrix[$x][$y];
                }
            }
        }
    }

    public function renderForm()
    {
        return '<form method="post">
    <div class="form-group row">

        <div class="col-md-2">
            <input required name="x" class="form-control" type="number" placeholder="X" min="2" max="12" value="' . (isset($_POST['x']) ?  $_POST['x'] : null )  . '">
        </div>

        <div class="col-md-2">
            <input required name="y" type="number" class="form-control" placeholder="Y" min="2" value="' . (isset($_POST['y']) ?  $_POST['y'] : null )  . '" >
        </div>

        <div class="col-md-3">
            <input name="submit" type="submit" class="btn btn-success" value="Generovat" >
        </div>

    </div>
</form>';
    }

    public function proccessForm()
    {
        if (isset($_POST['submit'])) {
            $this->x = $_POST['x'];
            $this->y = $_POST['y'];

            $this->generateMatrix();
        }
    }

    public function renderMatrix()
    {
        $html = '';
        $html .= '<div class="row">';
        $html .= '<div class="col-md-12">';
        $html .= 'Minimum je ' . $this->minimum . ' a v tabulce se vyskytuje ' . count($this->minimumValues) . 'x. (označeno jako červený text)';
        $html .= '<br>Maximum je ' . $this->maximum . ' a v tabulce se vyskytuje ' . count($this->maximumValues) . 'x. (označeno jako zelené pozadí)';
        $html .= '</div>';
        $html .= '</div>';

        for ($y = 1; $y <= $this->y; $y++) {
            $html .= '<div class="row" style="margin-bottom: 6px;">';
            for ($x = 1; $x <= $this->x; $x++) {
                $styles = "";
                $html .= '<div class="col-md-1">';
                $styles .= $this->isMinimum($x, $y);
                $styles .= $this->isMaximum($x, $y);

                $html .= '<span class="btn btn-default" style="font-weight: bold;' . $styles . '"' . '>' . $this->matrix[$x][$y] . '</span>';
                $html .= '</div>';
            }
            $html .= '</div>';

        }

        return $html;
    }

    private function isMinimum($x, $y)
    {
        foreach ($this->minimumValues as $min) {
            if ($x == $min[0] && $y == $min[1]) {
                return "color: red;";
            }
        }
    }

    private function isMaximum($x, $y)
    {
        foreach ($this->maximumValues as $max) {
            if ($x == $max[0] && $y == $max[1]) {
                return "background-color: green;";
            }
        }
    }

}