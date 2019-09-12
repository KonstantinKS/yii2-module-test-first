<?php

declare(strict_types=1);

namespace KonstantinKS\ModuleTestFirst\controllers;

use Demliz\DocumentIdentifier\Identifier\RslDocumentIdentifier;
use Demliz\RenderRsl\Access\ApiCredentials;
use Demliz\RenderRsl\Api;
use Demliz\RenderRsl\Domain\ResourceType\UnknownResourceType;
use Demliz\RenderRsl\Factory\ResourceTypeFactory;
use Demliz\RenderRsl\Service\DocumentContentService;
use Demliz\RenderRsl\Service\DocumentResourcesService;
use Demliz\RenderRsl\Service\HttpService;
use Exception;
use KonstantinKS\ModuleTestFirst\TestOneAssetsBundle;
use Yii;
use yii\web\Controller;

class RslDocumentController extends Controller
{
    //public $layout = 'main';

    /**
     * @return string
     * @throws Exception
     */
    public function actionIndex()
    {
        TestOneAssetsBundle::register($this->view);

        $httpService = new HttpService();

        $apiCredentials = ApiCredentials::create(
            Yii::$app->params['render']['renderAddress'],
            Yii::$app->params['render']['accessHeaderName'],
            Yii::$app->params['render']['accessKey']
        );

        $apiCredentialsAdditionalData = ApiCredentials::create(
            Yii::$app->params['render']['renderAddress'],
            Yii::$app->params['render']['accessHeaderName'],
            Yii::$app->params['render']['accessKey'],
            [
                'param1' => 'paramOne',
                'param2' => 'paramTwo',
                '=&&%%%///' => 'paramThree',
                123 => 'paramFour',
            ]
        );

        $resourceTypeFactory = new ResourceTypeFactory();

        $resourcesService = new DocumentResourcesService($httpService, $apiCredentials, $resourceTypeFactory);

        $contentService = new DocumentContentService($httpService, $apiCredentials);

        $renderNewApi = new Api($resourcesService, $contentService);

        $renderInit = Api::init(
            Yii::$app->params['render']['renderAddress'],
            Yii::$app->params['render']['accessKey'],
            Yii::$app->params['render']['accessHeaderName']
        );

        $renderInitAdditionalData = Api::init(
            Yii::$app->params['render']['renderAddress'],
            Yii::$app->params['render']['accessKey'],
            Yii::$app->params['render']['accessHeaderName'],
            [
                'param1' => 'paramOne',
                'param2' => 'paramTwo',
                '=&&%%%///' => 'paramThree',
                123 => 'paramFour',
            ]
        );

        ////////////////////////////////////////////////////////////////////////////////////////////
        $identifier = 'rsl01002054608';
        if (!RslDocumentIdentifier::match($identifier)) {
            throw new Exception('Некорректный формат идентификатора.');
        }
        $identifierEntity = new RslDocumentIdentifier($identifier);

        echo '<pre>';

        $resources = $renderInitAdditionalData->getResourceApi()->resources($identifierEntity);
        print_r($resources);
        echo '<br><br<br><hr><br><br><br>';

        $resourcesTypeSize = $renderInitAdditionalData->getResourceApi()->resourcesTypeSize(
            $identifierEntity,
            new UnknownResourceType('meta')
        );
        print_r($resourcesTypeSize);
        echo '<br><br<br><hr><br><br><br>';

        $resourcesType = $render->getResourceApi()->resourcesType($identifierEntity, 'meta');
        print_r($resourcesType);
        echo '<br><br<br><hr><br><br><br>';

        $documentCard = $render->getContentApi()->documentCard($identifierEntity);
        print_r($documentCard);
        echo '<br><br<br><hr><br><br><br>';

        $documentMarc = $render->getContentApi()->documentMarc($identifierEntity, '245', 'c');
        print_r($documentMarc);
        echo '<br><br<br><hr><br><br><br>';

        $documentCoverWidthHeight = $render->getContentApi()->documentCoverWidthHeight($identifierEntity, 100, 100);
        $documentCoverWidthHeightBase64 = base64_encode($documentCoverWidthHeight);
        echo "<img src='data:image/jpeg;base64,{$documentCoverWidthHeightBase64}' />";
        echo '<br><br<br><hr><br><br><br>';

        $documentCoverSize = $render->getContentApi()->documentCoverSize($identifierEntity, 1000);
        $documentCoverSizeBase64 = base64_encode($documentCoverSize);
        echo "<img src='data:image/jpeg;base64,{$documentCoverSizeBase64}' />";
        echo '<br><br<br><hr><br><br><br>';

        $documentInfo = $render->getContentApi()->documentInfo($identifierEntity);
        print_r($documentInfo);
        echo '<br><br<br><hr><br><br><br>';

        $documentType = $render->getContentApi()->documentType($identifierEntity);
        print_r($documentType);
        echo '<br><br<br><hr><br><br><br>';

        $documentAccess = $render->getContentApi()->documentAccess($identifierEntity);
        print_r($documentAccess);
        echo '<br><br<br><hr><br><br><br>';

        $documentCollections = $render->getContentApi()->documentCollections($identifierEntity);
        print_r($documentCollections);
        echo '<br><br<br><hr><br><br><br>';

        $pagesCount = $render->getContentApi()->pagesCount($identifierEntity);
        print_r($pagesCount);
        echo '<br><br<br><hr><br><br><br>';

        $documentPagesGeometry = $render->getContentApi()->documentPagesGeometry($identifierEntity, 11);
        print_r($documentPagesGeometry);
        echo '<br><br<br><hr><br><br><br>';

        $documentPages = $render->getContentApi()->documentPages(
            $identifierEntity,
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
            $identifierEntity,
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

        $documentPagesWordList = $render->getContentApi()->documentPagesWordList($identifierEntity, 11);
        print_r($documentPagesWordList);
        echo '<br><br<br><hr><br><br><br>';

        $documentPagesSearch = $render->getContentApi()->documentPagesSearch(
            $identifierEntity,
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
            $identifierEntity,
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
            $identifierEntity,
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

        $documentPageSet = $render->getContentApi()->documentPageSet($identifierEntity, [5, '4', '9-12', 112]);
        file_put_contents(__DIR__ . '/../../files/' . time() . '.tiff', $documentPageSet);
        $documentPageSetBase64 = base64_encode($documentPageSet);
        echo "<img src='data:image/tiff;base64,{$documentPageSetBase64}' />";
        echo '<br><br<br><hr><br><br><br>';


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $identifier = RslDocumentIdentifier::fromCatalogAndNumber('rsl01', '010060775');

        $resources = $render->getResourceApi()->resources($identifier);
        print_r($resources);
        echo '<br><br<br><hr><br><br><br>';

        $resourcesTypeSize = $render->getResourceApi()->resourcesTypeSize($identifier, 'meta');
        print_r($resourcesTypeSize);
        echo '<br><br<br><hr><br><br><br>';

        $resourcesType = $render->getResourceApi()->resourcesType($identifier, 'txt');
        print_r($resourcesType);
        echo '<br><br<br><hr><br><br><br>';

        $documentCard = $render->getContentApi()->documentCard($identifier);
        print_r($documentCard);
        echo '<br><br<br><hr><br><br><br>';

        $documentMarc = $render->getContentApi()->documentMarc($identifier, '245', 'c');
        print_r($documentMarc);
        echo '<br><br<br><hr><br><br><br>';

        $documentInfo = $render->getContentApi()->documentInfo($identifier);
        print_r($documentInfo);
        echo '<br><br<br><hr><br><br><br>';

        $documentType = $render->getContentApi()->documentType($identifier);
        print_r($documentType);
        echo '<br><br<br><hr><br><br><br>';
        //die;

        $documentAccess = $render->getContentApi()->documentAccess($identifier);
        print_r($documentAccess);
        echo '<br><br<br><hr><br><br><br>';

        $documentCollections = $render->getContentApi()->documentCollections($identifier);
        print_r($documentCollections);
        echo '<br><br<br><hr><br><br><br>';

        $pagesCount = $render->getContentApi()->pagesCount($identifier);
        print_r($pagesCount);
        echo '<br><br<br><hr><br><br><br>';

        $documentSearch = $render->getContentApi()->documentSearch(
            $identifier,
            [
                '0',
                0,
                'качества',
                'а',
                'все тело',
                'на ткани тела',
                'в частности, через «поющие чаши» дополнительно с чистым',
                null,
                'ВИКТОР ОГУИ и гнева. ',
            ]
        );
        print_r($documentSearch);
        echo '<br><br<br><hr><br><br><br>';

        $documentPagesGeometry = $render->getContentApi()->documentPagesGeometry($identifier, 12);
        print_r($documentPagesGeometry);
        echo '<br><br<br><hr><br><br><br>';

        $documentPages = $render->getContentApi()->documentPages(
            $identifier,
            12,
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
            13,
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

        $documentPagesWordList = $render->getContentApi()->documentPagesWordList($identifier, 12);
        print_r($documentPagesWordList);
        echo '<br><br<br><hr><br><br><br>';

        $documentPagesSearch = $render->getContentApi()->documentPagesSearch(
            $identifier,
            12,
            [
                'Изобретение',
                'а именно к восстановительной',
                '',
                'мм',
                null,
                ' или ',
                'составляет ',
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
                'Изобретение',
                'а именно к восстановительной',
                '',
                'мм',
                null,
                ' или ',
                'составляет ',
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
