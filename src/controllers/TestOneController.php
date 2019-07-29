<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\controllers;

use Demliz\RenderRsl\Identifier;
use Demliz\RenderRsl\Api;
use Demliz\RenderRsl\Services\DocumentContentService;
use Demliz\RenderRsl\Services\DocumentResourcesService;
use Demliz\RenderRsl\Services\HttpService;
use Exception;
use KonstantinKS\ModuleTestFirst\TestOneAssetsBundle;
use Yii;
use yii\web\Controller;
use KonstantinKS\ModuleTestFirst\models\ModuleTestFirstOne;

class TestOneController extends Controller
{
    //public $layout = 'main';

    public function actionIndex()
    {
        // регистрируем ресурсы:
        TestOneAssetsBundle::register($this->view);

        $datas = ModuleTestFirstOne::find()->all();

        return $this->render('index', [
            'data' => $datas,
            'render' => $render ?? false,
        ]);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionRenderStatic()
    {
        TestOneAssetsBundle::register($this->view);

        $identifier = new Identifier('rsl01009950491');

        //$identifier = new Identifier('rsl01009950495');

        //$identifier = new Identifier('rsl03111111111');

        //$identifier = new Identifier('rsl01000003450');

        $identifier = new Identifier('rsl01008702045');

        $identifier = new Identifier('rsl01009480455');

        //$identifier = new Identifier('rsl01009480450');

        $identifier = new Identifier('rsl01008704417');

        $httpService = new HttpService(
            Yii::$app->params['render']['renderAddress'],
            Yii::$app->params['render']['accessKey']
        );

        $resourcesService = new DocumentResourcesService($httpService);

        $contentService = new DocumentContentService($httpService);

        //$render = new Api($resourcesService, $contentService);

        $render = Api::init(
            Yii::$app->params['render']['renderAddress'],
            Yii::$app->params['render']['accessKey']
        );

        $resources = $render->getResourceApi()->resources($identifier);
        print_r($resources);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $resourcesTypeSize = $render->getResourceApi()->resourcesTypeSize($identifier, 'txt');
        print_r($resourcesTypeSize);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $resourcesType = $render->getResourceApi()->resourcesType($identifier, 'txt');
        print_r($resourcesType);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentCard = $render->getContentApi()->documentCard($identifier);
        print_r($documentCard);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentMarc = $render->getContentApi()->documentMarc($identifier, '245', 'c');
        print_r($documentMarc);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentCoverWidthHeight = $render->getContentApi()->documentCoverWidthHeight($identifier, 1000, 1000);
        $documentCoverWidthHeightBase64 = base64_encode($documentCoverWidthHeight);
        echo "<img src='data:image/jpeg;base64,{$documentCoverWidthHeightBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentCoverSize = $render->getContentApi()->documentCoverSize($identifier, 1000);
        $documentCoverSizeBase64 = base64_encode($documentCoverSize);
        echo "<img src='data:image/jpeg;base64,{$documentCoverSizeBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentInfo = $render->getContentApi()->documentInfo($identifier);
        print_r($documentInfo);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentType = $render->getContentApi()->documentType($identifier);
        print_r($documentType);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentAccess = $render->getContentApi()->documentAccess($identifier);
        print_r($documentAccess);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentCollections = $render->getContentApi()->documentCollections($identifier);
        print_r($documentCollections);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $pagesCount = $render->getContentApi()->pagesCount($identifier);
        print_r($pagesCount);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentSearch = $render->getContentApi()->documentSearch(
            $identifier,
            [
                '0',
                0,
                'ОБЩАЯ',
                'а',
                'провославие в балтии',
                'научно-аналитический журнал',
                '1111111111',
                null,
                'из-за',
            ]
        );
        print_r($documentSearch);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPagesGeometry = $render->getContentApi()->documentPagesGeometry($identifier, 11);
        print_r($documentPagesGeometry);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPages = $render->getContentApi()->documentPages(
            $identifier,
            11,
            'images',
            100,
            'jpeg',
            '0.1,0.135,0.75,0.75',
            ['0.420542,0.711466,0.837751,0.775353', '0.474167,0.375883,0.491477,0.389770', '0.2,0.2,0.23,0.23']
        );
        $documentPagesBase64 = base64_encode($documentPages);
        echo "<img src='data:image/tiff;base64,{$documentPagesBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPagesWidthHeight = $render->getContentApi()->documentPagesWidthHeight(
            $identifier,
            12,
            'images',
            'width',
            1000,
            'jpeg',
            '0.1,0.135,0.75,0.75',
            ['0.420542,0.711466,0.837751,0.775353', '0.474167,0.375883,0.491477,0.389770', '0.2,0.2,0.23,0.23']
        );
        $documentPagesWidthHeightBase64 = base64_encode($documentPagesWidthHeight);
        echo "<img src='data:image/tiff;base64,{$documentPagesWidthHeightBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPagesWordList = $render->getContentApi()->documentPagesWordList($identifier, 11);
        print_r($documentPagesWordList);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPagesSearch = $render->getContentApi()->documentPagesSearch(
            $identifier,
            12,
            [
                'собор',
                'собора',
                '',
                'Оказавшись в столь трудной ',
                null,
                'положительного решения',
                'монаст',
            ]
        );
        print_r($documentPagesSearch);
        echo '<br><br<br><hr><br><br><br>';
        $srtSearch = [];
        foreach ($documentPagesSearch as $keySearch => $search) {
            foreach ($search as $keyStr => $str) {
                $srtSearch[$keySearch . $keyStr] = $str['x1'];
                $srtSearch[$keySearch . $keyStr] .= ',' . $str['y1'];
                $srtSearch[$keySearch . $keyStr] .= ',' . $str['x2'];
                $srtSearch[$keySearch . $keyStr] .= ',' . $str['y2'];
            }
        }
        $documentPagesWidthHeight = $render->getContentApi()->documentPagesWidthHeight(
            $identifier,
            12,
            'images',
            'width',
            1000,
            'jpeg',
            null,
            $srtSearch
        );
        $documentPagesWidthHeightBase64 = base64_encode($documentPagesWidthHeight);
        echo "<img src='data:image/tiff;base64,{$documentPagesWidthHeightBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPagesSearchRender = $render->getContentApi()->documentPagesSearchRender(
            $identifier,
            12,
            [
                'согласия',
                'собора',
                '',
                'Оказавшись в столь трудной ',
                null,
                'положительного решения',
                'монаст',
            ],
            100,
            'jpeg',
            '0.1,0.135,0.75,0.75',
            ['0.420542,0.711466,0.837751,0.775353', '0.474167,0.375883,0.491477,0.389770', '0.2,0.2,0.23,0.23']
        );
        $documentPagesSearchRenderBase64 = base64_encode($documentPagesSearchRender);
        echo "<img src='data:image/tiff;base64,{$documentPagesSearchRenderBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentPageSet = $render->getContentApi()->documentPageSet($identifier, [5, '4', '9-12', 112]);
        file_put_contents(__DIR__ . '/../../files/' . time() . '.tiff', $documentPageSet);
        $documentPageSetBase64 = base64_encode($documentPageSet);
        echo "<img src='data:image/tiff;base64,{$documentPageSetBase64}' />";
        echo '<br><br<br><hr><br><br><br>';
        die;

        return $this->render('render-static', [
            'identifier' => $identifier ?? false,
            'render' => $render ?? false,
            'pagesCount' => $pagesCount ?? false,
            'resources' => $resources ?? false,
            'documentCard' => $documentCard ?? false,
            'image' => $image ?? false,
        ]);
    }
}
