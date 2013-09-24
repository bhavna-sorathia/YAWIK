<?php
/**
 * Cross Applicant Management
 *
 * @filesource
 * @copyright (c) 2013 Cross Solution (http://cross-solution.de)
 * @license   GPLv3
 */

/** FileSender.php */ 
namespace Core\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class FileSender extends AbstractPlugin
{
    
    public function __invoke($repositoryName, $fileId)
    {
        return $this->sendFile($repositoryName, $fileId);
    }
    
    public function sendFile($repositoryName, $fileId)
    {
        $repository = $this->getRepository($repositoryName);
        $file       = $repository->find($fileId);
        $response   = $this->getController()->getResponse();
        
        if (!$file) {
            $response->setStatusCode(404);
            return;
        }
        
        $response->getHeaders()->addHeaderline('Content-Type', $file->type)
                               ->addHeaderline('Content-Length', $file->size);
        $response->setContent($file->getContent());
        
        return $response;
        
        
    }
    
    protected function getRepository($name)
    {
        return $this->getController()
                    ->getServiceLocator()
                    ->get('repositories')
                    ->get($name);
    }
}

