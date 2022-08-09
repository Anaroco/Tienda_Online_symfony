<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

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
   

}

?>