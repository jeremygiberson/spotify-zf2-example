<?php

namespace Album\Controller;

use Album\Form\Search;
use Album\Service\AlbumServiceAwareInterface;
use Album\Service\AlbumServiceAwareTrait;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SearchController extends AbstractActionController implements AlbumServiceAwareInterface
{
    use AlbumServiceAwareTrait;

    public function indexAction()
    {
        $form = new Search();
        $albums = null;

        /** @var Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $albums = $this->getAlbumService()->search($data['album']);
            }
        }

        return new ViewModel(array('form' => $form, 'albums' => $albums));
    }

    public function ViewAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();
        $albumId = $request->getParam('id');

        $album = $this->getAlbumService()->get($albumId);
        return new ViewModel(['album' => $album]);
    }


}

