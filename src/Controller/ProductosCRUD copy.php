<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductoRepository;

use App\Entity\Producto;

 /**
 * @Route("/productos", name="database")
 */

class ProductosCRUD
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

/**
 * @Route("/insertar", name="insertar")
 */
public function insertar()
{
   $producto = new Producto();
   $producto->setTitulo("Camiseta Elvis");
   $producto->setDescripcion("Camiseta todas las tallas chica/chico");
   $producto->setPrecio(10.0);
   $producto->setIva(21);
   $producto->setFotos("elvis.png");
   $producto->setFotoportada("rock.png");
   $producto->setFichatecnica("ficha.pdf");

   $this->entityManager->persist($producto);
   $this->entityManager->flush();

   return new Response('<html><h1>Soy los productos</h1></html>');
}

/**
* @Route("/recuperar", name="recuperar")
*/
public function recuperar(ProductoRepository $productRepository)
{
    $id = 2;
    //$datos = $productRepository->findByIdField($id);
    $datos = $productRepository->find($id);
    var_dump($datos);
    return new Response('<html><h1>Soy el producto elegido por id</h1></html>');

}

/**
* @Route("/recuperarTitulo", name="recuperarTitulo")
*/
public function recuperarTitulo(ProductoRepository $productRepository)
{
    $titulo = "Camiseta Elvis";
    $datos = $productRepository->findBy(["titulo"=>$titulo]);
    var_dump($datos);
    return new Response('<html><h1>Soy el producto elegido por titulo</h1></html>');

}

/**
* @Route("/recuperarTodos", name="recuperarTodos")
*/
public function recuperarTodos(ProductoRepository $productRepository)
{
    $datos = $productRepository->findAll();
    var_dump($datos);
    return new Response('<html><h1>Soy todos los productos 🤖</h1></html>');

}

/**
* @Route("/borrar", name="borrar")
*/

public function borrar(ProductoRepository $productRepository)
{
    $id = 2;
    $producto = $productRepository->find($id);
    $productRepository->remove($producto, true);
    return new Response('<html><h1>Soy un borrado 😥</h1></html>');
}

/**
* @Route("/actualizar", name="actualizar")
*/

public function actualizar(ProductoRepository $productRepository)
{
    $id = 3;
    $producto = $productRepository->find($id);
    $producto->setTitulo("Camiseta de Gene");
    $productRepository->add($producto, true);
    return new Response('<html><h1>Soy un nuevo titulo 😎</h1></html>');
}



}

?>