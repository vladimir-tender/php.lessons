<?
namespace MyClasses;
//use \Product;

class CommonProduct extends Product
{
    public function show()
    {
        parent::show();
        echo "<b>Actual price: </b>{$this->getProductPrice()}";
    }

    public function sellDecision()
    {
        return "nothing";
    }
}