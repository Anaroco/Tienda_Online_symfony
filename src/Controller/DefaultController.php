<?php
	namespace App\Controller;
   	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
   	
	use App\Services\ProductService; 
 
   	class DefaultController extends AbstractController
	{
		public function index(ProductService $servicio):Response 
		{
			$productos = $servicio->todosProductos();
			return $this->render("base.html.twig",["productos"=>$productos]);
        }
	}
?>