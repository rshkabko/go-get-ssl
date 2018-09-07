<?php

namespace GoGetSSL;

/**
 * Class Product
 *
 * @package GoGetSSL
 * @author alzo02 <alzo02@icloud.com>
 */
class Product
{
    /**
     * @var Api
     */
    protected $api;

    /**
     * Product constructor.
     * @param Api $api
     */
    function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Gets all products
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->api->get("/products/");
    }

    /**
     * Gets product ID from Name
     *
     * @param string $name
     * @return bool|int
     * @throws \Exception
     */
    public function getIdFromName(string $name )
    {
        if(!$name)
            throw new \Exception('No name!');

        $products = self::getAll();
        if( !empty( $products->products ))
            foreach ( $products->products as $product )
                if( $product->name == $name )
                    return (int) $product->id;

        return false;
    }

    /**
     * Get details about product
     *
     * @param $id
     * @return mixed
     */
    public function getDetails($id)
    {
        return $this->api->get("/products/details/{$id}");
    }

    /**
     * Get prices for given product
     *
     * @param $id
     * @return mixed
     */
    public function getPrice($id)
    {
        return $this->api->get("/products/price/{$id}");
    }
}