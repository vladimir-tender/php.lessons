<?
namespace MyClasses;

abstract class Product
{
    private $id;
    private $type = 1;
    private $productName;
    private $productDescr;
    private $productCnt;
    private $productPrice;
    private $actualPrice;
    static $counter;

    abstract function sellDecision ();

    public function __construct($name, $price, $cnt, $descr)
    {
        $this->productName = strval($name);
        $this->productPrice = doubleval($price);
        $this->productCnt = intval($cnt);
        $this->productDescr = strval($descr);
        self::$counter++;
        $this->id = self::$counter;
    }

    public function show()
    {
        echo "<br>";
        echo "<b>ID:</b>{$this->id}<br>";
        echo "<b>Name:</b> {$this->productName} <br>";
        echo "<b>Description:</b> {$this->productDescr} <br>";
        echo "<b>In stock:</b> {$this->productCnt} <br>";
    }

    public function sellProduct($cnt)
    {
        $cnt = intval($cnt);
        if($this->productCnt >= $cnt)
        {
            $this->productCnt = $this->productCnt - $cnt;
            echo "Sold {$cnt} {$this->productName}<br>";
        }
        else
        {
            echo "Trying to sell {$cnt} items. Not enough, {$this->productCnt} {$this->productName} in stock <br>";
        }
    }

    public static function showCounter()
    {
        echo "<br>Count of products: " . self::$counter . "<br>";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return string
     */
    public function getProductDescr()
    {
        return $this->productDescr;
    }

    /**
     * @return int
     */
    public function getProductCnt()
    {
        return $this->productCnt;
    }

    /**
     * @return float
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * @return mixed
     */
    public function getActualPrice()
    {
        return $this->actualPrice;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @param string $productDescr
     */
    public function setProductDescr($productDescr)
    {
        $this->productDescr = $productDescr;
    }

    /**
     * @param int $productCnt
     */
    public function setProductCnt($productCnt)
    {
        $this->productCnt = $productCnt;
    }

    /**
     * @param float $productPrice
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }

    /**
     * @param mixed $actualPrice
     */
    public function setActualPrice($actualPrice)
    {
        $this->actualPrice = $actualPrice;
    }



}
