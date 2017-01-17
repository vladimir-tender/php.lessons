<?
namespace MyClasses;

class SmallORM
{
    public function __construct($dsn, $username = "", $password = "")
    {
        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            echo "<b>Database connection error</b>: " . $ex->getMessage() . "<br>";
        }
    }

    public function saveProduct(Product $product)
    {//TimeDiscountProduct $product, CntDiscountProduct $product, CommonProduct $product
        //\Product $product
        $sql = "INSERT INTO product (product_type, product_name, description, cnt, price, discountstart, discountend, discount) 
                             VALUES (:product_type, :product_name, :description, :cnt, :price, :discountstart, :discountend, :discount)";
        if ($product->getType() == 1 || $product->getType() == 2) {
            $discountstart = "null";
            $discountend = "null";
            $discount = "0";
            /**
             * @var TimeDiscountProduct $product
             */
            if ($product->getType() == 2) $discount = $product->getDiscountPercent();

        } elseif ($product->getType() == 3) {
            /**
             * @var TimeDiscountProduct $product
             */
            $discountstart = $product->startDscDate->format("Y-m-d H:i:s");
            $discountend = $product->endDscDate->format("Y-m-d H:i:s");
            $discount = $product->getDiscountPercent();
        } else {
            echo "Unknown product type.</br>{$product->getType()}";
            die();
        }

        try {
            $sth = $this->pdo->prepare($sql);
        } catch (\Exception $exception) {
            echo "Some problem with preparing sql query " . $exception . "<br>";
            die();
        }


        $sth->bindParam(":product_type", $product->getType());
        $sth->bindParam(":product_name", $product->getProductName());
        $sth->bindParam(":description", $product->getProductDescr());
        $sth->bindParam(":cnt", $product->getProductCnt());
        $sth->bindParam(":price", $product->getProductPrice());
        $sth->bindParam(":discountstart", $discountstart);
        $sth->bindParam(":discountend", $discountend);
        $sth->bindParam(":discount", $discount);

        try {
            $sth->execute();
        } catch (\Exception $exception) {
            echo "Some problem with execute sql query " . $exception . "<br>";
            die();
        }

        echo "Everything is OK!<br>";

    }

    public function selectProduct($id)
    {
        $sql = "SELECT * FROM product WHERE id = :id";
        try {
            $sth = $this->pdo->prepare($sql);
        } catch (\Exception $exception) {
            echo "Some problem with preparing sql query " . $exception . "<br>";
            die();
        }

        $sth->bindParam(":id", $id, \PDO::PARAM_INT);
        try {
            $sth->execute();
        } catch (\Exception $exception) {
            echo "Some problem with SELECT product. " . $exception . "<br>";
            die();
        }

        $data = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $type = $data[0]["product_type"];

        if ($type == 1) {
            $new_obj = new CommonProduct($data[0]["product_name"], $data[0]["price"], $data[0]["cnt"], $data[0]["description"]);
        } elseif ($type == 2) {
            $new_obj = new CntDiscountProduct($data[0]["product_name"], $data[0]["price"], $data[0]["cnt"], $data[0]["description"], $data[0]["discount"]);
        } elseif ($type == 3) {
            $discountStart = $data[0]["discountstart"];
            $discountEnd = $data[0]["discountend"];
            $new_obj = new TimeDiscountProduct($data[0]["product_name"], $data[0]["price"], $data[0]["cnt"], $data[0]["description"], $discountStart, $discountEnd, $data[0]["discount"]);
        } else {
            echo "some problem with selected product type or maybe there is no such <b>ID</b> in DB";
            $new_obj = "";
        }

        return $new_obj;

    }

}