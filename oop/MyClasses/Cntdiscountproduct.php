<?
namespace MyClasses;
//use \Product;

class CntDiscountProduct extends Product
{
	private $discountPercent;

	public function __construct ($name, $price, $cnt, $descr, $discountPercent)
	{
		parent::__construct($name, $price, $cnt, $descr);
		$this->discountPercent = intval($discountPercent);
		$this->setProductPrice(doubleval($price));
        $this->setType(2);
	}

	public function show()
	{
		parent::show();
		echo "<b>First price:</b> {$this->getProductPrice()}<br>";
		echo "<b>Discount:</b> {$this->getDiscountPercent()}%<br>";
		echo "<b>Offer:</b> {$this->sellDecision()} <br>";
		echo "<b>Actual Price:</b> {$this->getActualPrice()} <br>";
	}

	public function sellDecision()
    {
        if($this->getProductCnt() > 0)
        {
            $this->setActualPrice($this->getProductPrice() * (100 - $this->getDiscountPercent()) /100);
            return "valid";
        }
        else
        {
            $this->setActualPrice($this->getProductPrice());
            return "invalid";
        }
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