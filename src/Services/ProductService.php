<?php
    // namespace App\Services;
    // use App\Entity\ProductoDTO;

    // class ProductService
    // {
    //     public $productos=[];

    //     public function __construct()
    //     {
    //         $producto = new ProductoDTO("Titulo", "pikachu.png","pikachu.png","ficha.pdf");
    //         $this->productos[0]=$producto;
    //         $producto = new ProductoDTO("Titulo 2", "pikachu.png","pikachu.png","ficha.pdf");
    //         $this->productos[1]=$producto;
    //         $producto = new ProductoDTO("Titulo 3", "pikachu.png","pikachu.png","ficha.pdf");
    //         $this->productos[2]=$producto;
    //         $producto = new ProductoDTO("Titulo 4", "pikachu.png","pikachu.png","ficha.pdf");
    //         $this->productos[3]=$producto;
    //     }
    //     public function todosProductos()
    //     {
    //         return $this->productos;
    //     }
    //     public function unProducto($titulo)
    //     {
    //         return $this->productos[0];
    //     }
    // }

    namespace App\Services;
    use App\Entity\ProductoDTO;
    use App\Repository\ProductoRepository;

    class ProductService
    {
        public $productRepository;

        public function __construct(ProductoRepository $productRepository)
        {
          $this->productRepository = $productRepository;
        }
        public function todosProductos()
        {
            return $this->productRepository->findAll();
        }
        public function unProducto($id)
        {
            return $this->productRepository->find($id);
        }
    }

?>