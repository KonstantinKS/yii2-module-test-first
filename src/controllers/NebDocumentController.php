<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\controllers;

use Demliz\RenderRsl\Api;
use Demliz\RenderRsl\NebDocumentIdentifier;
use Demliz\RenderRsl\RslDocumentIdentifier;
use Demliz\RenderRsl\Service\DocumentContentService;
use Demliz\RenderRsl\Service\DocumentResourcesService;
use Demliz\RenderRsl\Service\HttpService;
use Exception;
use KonstantinKS\ModuleTestFirst\TestOneAssetsBundle;
use Yii;
use yii\web\Controller;

/**
 * Проверка работы demliz-org/render-api-wrapper с документом из НЭБ
 *
 * @author Konstantin Karpov <k-karpov@inbox.ru>
 */
final class NebDocumentController extends Controller
{
    //public $layout = 'main';

    /**
     * Проверка выполнения всех методов обёртки с документом НЭБ
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex()
    {
        TestOneAssetsBundle::register($this->view);

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


        //$identifier = new Identifier('rsl01009950491');

        //$identifier = new Identifier('rsl01009950495');

        //$identifier = new Identifier('rsl03111111111');

        //$identifier = new Identifier('rsl01000003450');

        //$identifier = new Identifier('rsl01008702045');

        //$identifier = new Identifier('rsl01009480455');

        //$identifier = new Identifier('rsl01009480450');

        ////////////////////////////////////////////////////////////////////////////////////////////
        $identifier = new NebDocumentIdentifier('000207_000017_RU_RGDB_BIBL_0000354719');
        echo '<pre>';
        print_r($identifier);

        $resources = $render->getResourceApi()->resources($identifier);
        print_r($resources);
        echo '<br><br<br><hr><br><br><br>';

        $resourcesTypeSize = $render->getResourceApi()->resourcesTypeSize($identifier, 'meta');
        print_r($resourcesTypeSize);
        echo '<br><br<br><hr><br><br><br>';

        $resourcesType = $render->getResourceApi()->resourcesType($identifier, 'meta');
        print_r($resourcesType);
        echo '<br><br<br><hr><br><br><br>';

        $documentCard = $render->getContentApi()->documentCard($identifier);
        print_r($documentCard);
        echo '<br><br<br><hr><br><br><br>';

        $documentMarc = $render->getContentApi()->documentMarc($identifier, '245', 'c');
        print_r($documentMarc);
        echo '<br><br<br><hr><br><br><br>';

        $documentCoverWidthHeight = $render->getContentApi()->documentCoverWidthHeight($identifier, 100, 100);
        $documentCoverWidthHeightBase64 = base64_encode($documentCoverWidthHeight);
        echo "<img src='data:image/jpeg;base64,{$documentCoverWidthHeightBase64}' />";
        echo '<br><br<br><hr><br><br><br>';

        $documentCoverSize = $render->getContentApi()->documentCoverSize($identifier, 1000);
        $documentCoverSizeBase64 = base64_encode($documentCoverSize);
        echo "<img src='data:image/jpeg;base64,{$documentCoverSizeBase64}' />";
        echo '<br><br<br><hr><br><br><br>';

        $documentInfo = $render->getContentApi()->documentInfo($identifier);
        print_r($documentInfo);
        echo '<br><br<br><hr><br><br><br>';

        $documentType = $render->getContentApi()->documentType($identifier);
        print_r($documentType);
        echo '<br><br<br><hr><br><br><br>';

        $documentAccess = $render->getContentApi()->documentAccess($identifier);
        print_r($documentAccess);
        echo '<br><br<br><hr><br><br><br>';

        $documentCollections = $render->getContentApi()->documentCollections($identifier);
        print_r($documentCollections);
        echo '<br><br<br><hr><br><br><br>';

        $pagesCount = $render->getContentApi()->pagesCount($identifier);
        print_r($pagesCount);
        echo '<br><br<br><hr><br><br><br>';

        $documentPagesGeometry = $render->getContentApi()->documentPagesGeometry($identifier, 11);
        print_r($documentPagesGeometry);
        echo '<br><br<br><hr><br><br><br>';

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

        $documentPagesWordList = $render->getContentApi()->documentPagesWordList($identifier, 11);
        print_r($documentPagesWordList);
        echo '<br><br<br><hr><br><br><br>';

        $documentPagesSearch = $render->getContentApi()->documentPagesSearch(
            $identifier,
            12,
            [
                '12',
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

        $documentPagesSearchRender = $render->getContentApi()->documentPagesSearchRender(
            $identifier,
            12,
            [
                'берегов',
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

        $documentPageSet = $render->getContentApi()->documentPageSet($identifier, [5, '4', '9-12', 112]);
        file_put_contents(__DIR__ . '/../../files/' . time() . '.tiff', $documentPageSet);
        $documentPageSetBase64 = base64_encode($documentPageSet);
        echo "<img src='data:image/tiff;base64,{$documentPageSetBase64}' />";
        echo '<br><br<br><hr><br><br><br>';

//        return $this->render('render-static', [
//            'identifier' => $identifier ?? false,
//            'render' => $render ?? false,
//            'pagesCount' => $pagesCount ?? false,
//            'resources' => $resources ?? false,
//            'documentCard' => $documentCard ?? false,
//            'image' => $image ?? false,
//        ]);
    }
}
