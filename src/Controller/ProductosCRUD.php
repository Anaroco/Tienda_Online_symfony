<?php

    namespace App\Controller;

    use Symfony\Component\Routing\Annotation\Route; 
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Response; 
    use App\Repository\ProductoRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
    use Symfony\Component\HttpFoundation\Request;
    use App\Services\ProductService;
    use App\Form\Type\ProductosType;
    use Symfony\Component\String\Slugger\AsciiSlugger;

    use App\Entity\Producto;
    /**
    * @Route("/productos", name="database")
    */
    class ProductosCRUD extends AbstractController
    {
        private $productoService;

        public function __construct(ProductService $productoService)
        {
            $this->productoService = $productoService;
        }
        /**
        * @Route("/todos", name="todos")
        */
        public function todos()
        {
            $productos = $this->productoService->todosProductos();
            return $this->render("productos.html.twig",["productos"=>$productos]);
        }

        /**
        * @Route("/id/{id}", name="unproductoid")
        */
        public function unproducto($id)
        {
            $producto = $this->productoService->unProducto($id);
            return $this->render("producto.html.twig",["producto"=>$producto]);
        }

        private function procesarImagen($imagen)
        {
            $slugger = new AsciiSlugger();
            if($imagen)
            {
                $nombreOriginal = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                $nombreGuardar = $slugger->slug($nombreOriginal)."-".uniqid().".".$imagen->guessExtension();
                
                try
                {
                    $directory =  $this->getParameter('kernel.project_dir');
                    $ruta = $directory."\\uploads\\".date("F")."\\";
                    $fichero = $imagen->move($ruta,$nombreGuardar);
                    return $ruta.$nombreGuardar;
                }

                catch(Excepcion $e)
                {
                    echo("Error al subir el fichero");
                    return false;
                }
            }
            else
            {
                return "";
            }
            return false;
        }

        private function formulario($producto,$request,ProductoRepository $productRepository)
        {

            $formulario = $this->createForm(ProductosType::class, $producto);
            $alta = "-1";
            $formulario->handleRequest($request);
            if($formulario->isSubmitted())
            {
               
                if($formulario->isValid())
                {
                    $fotos = $formulario->get("fotos")->getData();   
                    $fotos = $this->procesarImagen($fotos);

                    $fotoportada = $formulario->get("fotoportada")->getData();
                    $fotoportada = $this->procesarImagen($fotoportada);
                   
                    $fichatecnica = $formulario->get("fichatecnica")->getData();
                    $fichatecnica = $this->procesarImagen($fichatecnica);
                    
                    if($fotos==false || $fotoportada ==false || $fichatecnica==false )
                    {
                        $alta = false;
                    }
                    else
                    {
                        $producto->setFotos($fotos);
                        $producto->setFotoportada($fotoportada);
                        $producto->setFichatecnica($fichatecnica);
                        $productRepository->add($producto, true);
                        $alta = true;
                
                    }
                }
                else
                {
                    $alta = false;
                }
            }
            $devolucion["formulario"] = $formulario;
            $devolucion["alta"] = $alta;

            return $devolucion;
        }
        /**
        * @Route("/editar/{id}", name="editarproducto")
        */
        public function editarproducto(Request $request, ProductoRepository $productRepository, $id)
        {
            $producto = $productRepository->find($id);
            $devolucion = $this->formulario($producto, $request,$productRepository);
            $formulario = $devolucion["formulario"];
            $alta = $devolucion["formulario"];

            return $this->render(
                                    'productos/formularioProducto.html.twig',
                                    [
                                        'formulario' => $formulario->createView(),
                                        'alta' => $alta
                                    ]
                                );
            
        }
        /**
        * @Route("/alta", name="altaproducto")
        */
        public function altaproducto(Request $request, ProductoRepository $productRepository)
        {

            $producto = new Producto();
            $devolucion = $this->formulario($producto, $request,$productRepository);
            $formulario = $devolucion["formulario"];
            $alta = $devolucion["alta"];

            return $this->render(
                                    'productos/formularioProducto.html.twig',
                                    [
                                        'formulario' => $formulario->createView(),
                                        'alta' => $alta
                                    ]
                                );
        }
        /**
        * @Route("/borrar/{id}", name="borrarproductoid")
        */
        public function borrarproducto($id,ProductoRepository $productRepository)
        {
            $producto = $productRepository->find($id);
            if($producto!=null)
            {
                $productRepository->remove($producto,true);
                $productos = $this->productoService->todosProductos();
                return $this->render("productos.html.twig",["productos"=>$productos]);
            }
            else
            {
                return $this->render("error_producto.html.twig",["productos"=>$productos]);
            }
        }

    }
?>