<?php

class Local{
    private $productosEnVenta;

    public function __construct($productos)
    {
        $this->productosEnVenta = $productos;
    }

    public function getProductosEnVenta(){
        return $this->productosEnVenta;
    }

    public function setProductosEnVenta($productosEnVenta){
        $this->productosEnVenta = $productosEnVenta;
    }

    /** incorporates a new product if it is not in the store
     * @param $objProducto
     * @return bool
     */

    public function incorporarProductoTienda($objProducto){
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        if($n == 0){
            $incorporated = true;
        } else{
            for($i = 0; $i < $n; $i++){
                if($objProducto->getCodigoBarra() != $productos[$i]->getCodigoBarra()){
                    $incorporated = true;
                }else{
                    $incorporated = false;
                }
            }
        }
        
        if($incorporated == true){
            $productos[$n] = $objProducto;
            $this->setProductosEnVenta($productos);
        }
        return $incorporated;
    }

    /** Returns the sale price of a product
     * @param int $codProducto
     * @param int
     */

    public function retornarImporteProducto($codProducto){
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        $precio = 0;
        for($i = 0; $i < $n; $i++){
            if($codProducto == $productos[$i]->getCodigoBarra()){
                $precio = $productos[$i]->darPrecioVenta();
                break;
            }
        }
        return $precio;
    }

    /** We return the total cost in products that are in the store
     * @return int
     */

    public function retornarCostoProductoTienda(){
        $totalCosto = 0;
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        for($i = 0; $i < $n; $i++){
            $cantidad = $productos[$i]->getStock();
            $precio = $productos[$i]->darPrecioVenta();
            $totalCosto += ($cantidad * $precio);
        }
        return $totalCosto;
    }

}