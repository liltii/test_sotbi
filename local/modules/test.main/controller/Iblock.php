<?php
namespace Test\Main\Controller;


use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;

class Iblock extends Controller
{
    private \Test\Main\Iblock $iblock;

    public function getDefaultPreFilters(): array
    {
        return [
//            new ActionFilter\Authentication(),
//            new ActionFilter\HttpMethod(
//                [ActionFilter\HttpMethod::METHOD_GET, ActionFilter\HttpMethod::METHOD_POST]
//            ),
//            new ActionFilter\Csrf(),
        ];
    }

    protected function prepareParams(): bool
    {
        $this->iblock = new \Test\Main\Iblock();
        return parent::prepareParams();
    }

    /**
     * Создание ИБ
     * @return bool
     * @throws \Exception
     */
    public function createAction()
    {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        return $this->iblock->create($data);
    }

    /**
     * Создание свойств для ИБ
     * @return bool
     * @throws \Exception
     */
    public function addElementAction()
    {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        return $this->iblock->addElement($data);
    }
}