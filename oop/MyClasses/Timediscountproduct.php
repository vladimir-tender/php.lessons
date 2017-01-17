<?
namespace MyClasses;
use DateTime;

class TimeDiscountProduct extends Product
{
    private $discountPercent;
    public $startDscDate;
    public $endDscDate;

    public function __construct($name, $price, $cnt, $descr, $startDate, $endDate, $discountPercent)
    {
        parent::__construct($name, $price, $cnt, $descr);
        $this->setDiscountPercent(intval($discountPercent));

        try{
            $this->startDscDate = new DateTime($startDate);
        }
        catch (\Exception $ex) {
            echo "Incorrect start_date format for object {$name}. Setting default time ".date("Y-m-d")."</br>";
            $this->startDscDate = new DateTime(date("Y-m-d"));
        }

        try{
            $this->endDscDate = new DateTime($endDate);
        }
        catch (\Exception $ex)
        {
            echo "Incorrect end_date format for object {$name}. Setting default time ".date("Y-m-d")."</br>";
            $this->endDscDate = new DateTime(date("Y-m-d"));
        }


        $this->setType(3);
    }

    public function sellDecision()
    {
        $this->setActualPrice($this->getProductPrice());

        $startTime = $this->startDscDate->format("Y-m-d");
        $endTime = $this->endDscDate->format("Y-m-d");
        $now = date("Y-m-d",time())."__";
        //echo $now;

        if ($startTime > $now) {
            return "doesn't start <br>";
        } elseif (($startTime < $now && $now < $endTime) || $endTime == $startTime) {
            $this->setActualPrice((($this->getProductPrice()) * (100 - $this->getDiscountPercent()) / 100));
            return "is valid <br>";
        } elseif ($endTime < $now) {
            return "has finished <br>";
        } else {
            return "Some problem with date format <br>";
        }

    }

    public function show()
    {
        parent::show();
        echo "<b>Start date discount:</b> {$this->startDscDate->format("d.m.Y")} <br>";
        echo "<b>End date discount:</b> {$this->endDscDate->format("d.m.Y")} <br>";
        echo "<b>First Price:</b> {$this->getProductPrice()} <br>";
        echo "<b>Discount:</b> {$this->getDiscountPercent()}% <br>";
        echo "<b>Offer:</b> {$this->sellDecision()}";
        echo "<b>Actual price:</b> {$this->getActualPrice()} <br>";
    }

    /**
     * @return int
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * @param int $discountPercent
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;
    }

}
