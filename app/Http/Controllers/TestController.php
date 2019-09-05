<?php

namespace App\HTTP\Controllers;

use function Composer\Autoload\includeFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Jos\Request\ImgzoneCategoryAddRequest;
use Jos\Request\ImgzoneCategoryQueryRequest;
use Jos\Request\ImgzonePictureUploadRequest;

class TestController extends BaseController
{
    public $jd_con;
    public $appKey;
    public $appSecret;
    public $token;

    public function __construct()
    {
        $this->appKey    = "1DCE541099905A7EFDB0FF2922572DDA";
        $this->appSecret = "6b4f0eab6f4549d581ffb5f7619e6567";
//        $this->token     = "cfd0a541abb24ef28b3807225a87a4ccndfh";
        $this->token     = "2c63d34e7bac4e4ca60baeec5e362a532qzn";
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/JdClient.php";
        $this->jd_con              = new \JdClient();
        $this->jd_con->appKey      = $this->appKey;
        $this->jd_con->appSecret   = $this->appSecret;
        $this->jd_con->accessToken = $this->token;
    }

    public static function test(Request $request)
    {

        $user = DB::table("first")->select("*")->get()->toArray();
        return view("yierLogin");
    }

    public static function miss(Request $request)
    {
        var_dump($request->input("name"));
        var_dump($request->all());
        return view("miss");
    }

    public static function JdApi(Request $request)
    {
        return view("jdapi");
    }

    /**
     * 获取所有分类接口
     * @param Request $request
     * author Bruce
     */
    public function getJdApi(Request $request)
    {
        $vals = [];
//        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/CategoryReadFindAttrsByCategoryIdJosRequest.php";
        $req = new \VenderCategoryGetValidCategoryResultByVenderIdRequest();
        $req = new \SellerVenderInfoGetRequest();

//        $req->setCid(5258);
//        $req->setAttributeType(3);
        $resp = $this->jd_con->execute($req, $this->jd_con->accessToken);
//        $resp = self::obj2Arr($resp);
//        foreach($resp['getvalidcategoryresultbyvenderid_result']['list'] as $key=>$value){
//            $reqa = new \CategoryReadFindAttrsByCategoryIdJosRequest();
//            $reqa->setCid($value['id']);
//            $reqa->setAttributeType(4);
//            $respa = $this->jd_con->execute($reqa, $this->jd_con->accessToken);
//            $respa = self::obj2Arr($respa);
//            foreach ($respa['categoryAttrs'] as $val){
//                if($val['attName'] =='款式'){
//                    echo "<pre>";
//                    print_r($respa);die();
//                }
//                if(in_array($val['attName'],$vals)){
//                    continue;
//                }
//                else{
//                    $vals[]  = $val['attName'];
//                }
//            }
//        }
        echo "<pre>";
        print_r($resp);
//        echo "<pre>";
//        print_r($resp);
    }

    /**
     * 获取单个分类接口
     * @param Request $request
     * author Bruce
     */
    public function getOneJdApi(Request $request)
    {        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/CategoryWriteSaveVenderAttrValueRequest.php";
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/WareWriteUpdateWareSaleAttrvalueAliasRequest.php";
    require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/ImgzoneCategoryQueryRequest.php";
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/ImgzonePictureUploadRequest.php";
//        $req = new \CategoryReadFindByIdRequest();
//        $req->setCid(6918);

//        $req = new \VenderShopcategoryFindShopCategoriesByVenderIdRequest();


//        $req = new \CategoryReadFindValuesByAttrIdUnlimitRequest();
//        $req->setCategoryAttrId(15060);

//                $req = new \CategoryReadFindAttrByIdRequest();
//        $req->setAttrId(1000003593);

//         $req = new \SkuFareTemplateServiceGetTemplatesRequest();
        $req = new \PopVenderCenerVenderBrandQueryRequest();



//        $req = new \CategoryReadFindAttrsByCategoryIdRequest();
//        $req->setCid(6918);
//        $req->setAttributeType(3);
////
//        $req = new \CategoryReadFindValuesByAttrIdRequest();
//        $req->setCategoryAttrId(1000000162);
////
        $req = new \CategoryReadFindAttrsByCategoryIdUnlimitCateRequest();
        $req->setCid(12101);
////        $req->setAttributeType();
////
//        $req = new \CategoryReadFindValuesByAttrIdUnlimitRequest();
//        $req->setCategoryAttrId(87771);

//        $req = new \EptFeightOutapiQueryRequest();//运费模板
//        $req->setPageSize(10);
//        $req->setCurrentPage(0);

//       $req = new \TemplateReadFindTemplatesByVenderIdRequest();//关联版式
//
//        $req = new ImgzoneCategoryAddRequest();
//        $req->setCateName('pim自动上架');
//        $req = new ImgzoneCategoryQueryRequest();
//        $req->setCateName('pim自动上架');

        //新增销售属性
//        $req = new \CategoryWriteSaveVenderAttrValueRequest();
//        $req->setAttValue('test尺码1');
//        $req->setAttributeId(1001034383);
//        $req->setCategoryId(14934);
//        $req->setIndexId(1);
//        $req->setKey('class');

//        新增图片
//        $req = new  ImgzonePictureUploadRequest();
//        $image = __DIR__ . "/../../../public/images/ms.jpg";
//        $type=getimagesize($image);
//        //取得图片的大小，类型等
//         $content=file_get_contents($image);
//         $file_content=chunk_split(base64_encode($content));//base64编码
//         switch($type[2]){//判读图片类型
//           case 1:$img_type="gif";break;
//           case 2:$img_type="jpg";break;
//           case 3:$img_type="png";break;
//         }
//           $img='data:image/'.$img_type.';base64,'.$file_content;//合成图片的base64编码
//var_dump($img);die();
//        $content =file_get_contents($image);
//        $content = fread(fopen($image,'r'),filesize(__DIR__ . "/../../../public/images/ms.jpg"));
//        $content = base64_encode($content);
//        var_dump($content);die();
//        $req->setImageData($img);
//        $req->setPictureCateId(85077775);
//        $req->setPictureName('ksz-200');


//                $req = new \WareWriteUpdateWareSaleAttrvalueAliasRequest();
//        $req->setWareId(12930158487);
//        $req->setProps([
//            [
//                "attrId"     => "1000003592",
//                "attrValues" => ["1505801799"],
//                "attrValueAlias"=>['尺码2'],
//            ],
//            [
//                "attrId"     => "1000003624",
//                "attrValues" => ["1505816919"],
//                "attrValueAlias"=>['颜色2'],
//            ]
//        ]);jingdong.transparentImage.write.add   jingdong.transparentImage.write.update


//        $req->putOtherTextParam('@type','com.jd.pop.ware.ic.api.domain.Prop');
        $resp = $this->jd_con->execute($req, $this->jd_con->accessToken);
        $resp = self::obj2Arr($resp);
        echo "<pre>";
        print_r($resp);
    }

    /**
     * 获取单个分类接口
     * @param Request $request
     * author Bruce
     */
    public function getCategory(Request $request)
    {
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/TemplateReadFindTemplatesByVenderIdRequest.php";
        $req  = new \TemplateReadFindTemplatesByVenderIdRequest();
        $resp = $this->jd_con->execute($req, $this->jd_con->accessToken);
        $resp = self::obj2Arr($resp);
        echo "<pre>";
        print_r($resp);
    }


    /**
     * 获取单个类目信息
     * @param Request $request
     * author Bruce
     */
    public function getCategoryInfo(Request $request)
    {
        $category_arr = $this->getCategoryAttrValue();
//        echo "<pre>";
//        print_r($category_arr);die();
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/WareWriteAddRequest.php";
        $req                 = new \WareWriteAddRequest();
        $skus                = [];
        $ware["venderid"]    = "64877";//jingdong.seller.vender.info.get
        $ware["title"]       = "测试多商品";
        $ware["marketprice"] = 9999;
//        $ware["transportid"] = 720609;
//        $ware['shopcategorys'] = [6900648];
//        $ware['thwa'] = 3;
        $ware["brandid"]     = "18512";//jingdong.pop.vender.cener.venderBrand.query
        $ware["categoryid"]  = 12101;//jingdong.vender.category.getValidCategoryResultByVenderId
//        $ware["transportId"] = 0;//jingdong.ept.feight.outapi.query
//        $ware["wareStatus"]  = 8;
//        $ware["templateId"]   = 4088912;
        $ware["multicateprops"] = $category_arr;
//        $ware["features"]     = [
//            [
//                "featureKey"   => '
//color',
//                "featureValue" => 1
//            ],
//            [
//                "featureKey"   => 'size',
//                "featureValue" => 1
//            ],
//        ];
        $ware["images"]       = [
            [
                "colorId"  => "0000000000",
                "imgIndex" => 1,
                "imgUrl"   => "jfs/t22642/362/1874305058/128053/e9513d15/5b6c4806N4b395fd6.jpg",
            ],
            [
                "colorId"  => "0000000000",
                "imgIndex" => 2,
                "imgUrl"   => "jfs/t17293/178/2445912977/195350/e3a72b96/5afaa470Ne5d3c3f7.jpg",
            ],
            [
                "colorId"  => "0000000000",
                "imgIndex" => 3,
                "imgUrl"   => "jfs/t18856/77/2688297788/87923/2c5702b7/5b06ddf5N54418c93.jpg",
            ],
            [
                "colorId"  => "0000000000",
                "imgIndex" => 4,
                "imgUrl"   => "jfs/t24703/242/347401551/162062/b8f44be4/5b6c4b9fNecc70991.jpg",
            ],
            [
                "colorId"  => "0000000000",
                "imgIndex" => 5,
                "imgUrl"   => "jfs/t17293/178/2445912977/195350/e3a72b96/5afaa470Ne5d3c3f7.jpg",
            ],
            [
                "colorId"  => "0000000000",
                "imgIndex" => 6,
                "imgUrl"   => "jfs/t17293/178/2445912977/195350/e3a72b96/5afaa470Ne5d3c3f7.jpg",
            ],
            [
                "colorId"  => "0000000000",
                "imgIndex" => 7,
                "imgUrl"   => "jfs/t17293/178/2445912977/195350/e3a72b96/5afaa470Ne5d3c3f7.jpg",
            ],

        ];
        $ware["mobiledesc"]   = '<img src="//img10.360buyimg.com/imgzone/jfs/t23725/17/2207732792/292236/b44bb7f/5b76b0ecN182c09f1.jpg" alt="">
        <img src="//img10.360buyimg.com/imgzone/jfs/t24949/133/636515343/405241/432b8bbb/5b76b0eaN8c901896.png" alt="">';
        $ware["introduction"] = '<img src="//img10.360buyimg.com/imgzone/jfs/t23725/17/2207732792/292236/b44bb7f/5b76b0ecN182c09f1.jpg" alt="">
        <img src="//img10.360buyimg.com/imgzone/jfs/t24949/133/636515343/405241/432b8bbb/5b76b0eaN8c901896.png" alt="">';
        $ware["weight"]       = 14;
        $ware['length']       = 20;
        $ware['width']        = 20;
        $ware['height']       = 20;
        $ware['itemNum']        = 'kkk';

        $ware['jdprice']      = '7005';
        $sku1['outerId'] = '3867382458';
//        $sku1['saleAttrs']    = [
//            [
//                "attrValueAlias"=>['尺码1'],
//                "attrId"     => "1000003625",
//                "attrValues" => ["1505805037"]
//            ],
//            [
//                "attrValueAlias"=>['颜色1'],
//                "attrId"     => "1000003608",
//                "attrValues" => ["1505817345"]
//            ]
//        ];
        $sku1['@type']        = 'com.jd.pop.ware.ic.api.domain.Sku';
        $sku1['jdPrice']      = 3000;
//        $sku1['multiCateProps']        = [
//            [
//                "attrId"     => "15105",
//                "attrValues" => ["248479","248486"]
//            ],
//        ];
        $sku2['outerId'] = '1234567';
        $sku2['saleAttrs'] = [
            [
                "attrValueAlias"=>['尺码2'],
                "attrId"     => "1000003625",
                "attrValues" => ["1505805037"]
            ],
            [
                "attrValueAlias"=>['颜色2'],
                "attrId"     => "1000003608",
                "attrValues" => ["1505817280"]
            ]
        ];
        $sku2['@type']     = 'com.jd.pop.ware.ic.api.domain.Sku';
        $sku2['jdPrice']   = 3000;
        $sku2['multiCateProps']        = [
            [
                "attrId"     => "15105",
                "attrValues" => ["248479","248486"]
            ],
        ];

        $skus = [$sku1];
        $req->setWare($ware);
        $req->setSkus($skus);
        $resp = $this->jd_con->execute($req, $this->jd_con->accessToken);
        $resp = self::obj2Arr($resp);
        echo "<pre>";
        print_r($resp);
    }


    public static function obj2Arr($data)
    {
        if (!is_array($data)) {
            $data = (array)$data;
        }
        foreach ($data as $k => $v) {
            if (is_object($v)) {
                $data[$k] = (array)$v;
            }
            if (is_array($data[$k])) {
                $data[$k] = self::obj2Arr($data[$k]);
            }
        }
        return $data;
    }

    /**
     * 获取通用属性和对应的值
     * @param Request $request
     * author Bruce
     */
    public function getCategoryAttrValue()
    {
        $arr_not = [156592, 8816];
        $arrs    = [];
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/CategoryReadFindAttrsByCategoryIdJosRequest.php";
        require __DIR__ . "/../../../vendor/windly/bruce/jd_sdk/jd/request/CategoryReadFindValuesByAttrIdRequest.php";
        $value_req = new \CategoryReadFindValuesByAttrIdUnlimitRequest();
        $req       = new \CategoryReadFindAttrsByCategoryIdUnlimitCateRequest();
        $req->setCid(12101);
        $req->setAttributeType(3);
        $resp = $this->jd_con->execute($req, $this->jd_con->accessToken);
        $resp = self::obj2Arr($resp);
        foreach ($resp['findattrsbycategoryidunlimitcate_result'] as $key => $value) {
            if ($value['name'] == '品牌' || $value['name'] == '尺码') {
                continue;
            }
            $value_req->setCategoryAttrId($value['id']);
            $cateValue_obj = $this->jd_con->execute($value_req, $this->jd_con->accessToken);
            $cateValue     = self::obj2Arr($cateValue_obj);
            if (isset($cateValue['findvaluesbyattridunlimit_result'][0])) {
//                if($value['categoryAttrId'] ==11798){
//                    $arr =  [
//                        "attrId"     => (string)$value['categoryAttrId'],
//                        "attrValues" => ['']
//                    ];
//                }
//                if (in_array($value['categoryAttrId'], $arr_not)) {
//                    continue;
//                }
//                else{
                    $arr    = [
                        "attrId"     => $value['id'],
                        "attrValues" => [$cateValue['findvaluesbyattridunlimit_result'][0]['id']]
                    ];
//                }

                $arrs[] = $arr;
            } else {
                continue;
            }
        }
//        $arrs[] = [
//            "attrId"     => "10126464",
//            "attrValues" => ["40"]
//        ];
//        $arrs[] = [
//            "attrId"     => "10126444",
//            "attrValues" => ["35"]
//        ];
//                    var_dump($arrs);

        $arrs[] = [
            "attrId"     => 80560,
            "attrValues" => [18512],
        ];
//    $arrs[] = [
//        "attrId"     => 87770,
//        "attrValues" => [1694099487],
//    ];
        return $arrs;
    }
}

//{"version":3,"id":"ecc0a3d5-2465-4aa3-a822-d45fabb27b3f","address":"0a7cb21397c2cc08deb1a5cfc7b4734a1244e5af","crypto":{"ciphertext":"581003196c778c65fcae40eb41c48b4c7353f3f61940d58a0cdecad5604a1db6","cipherparams":{"iv":"2612b178358c6b99a1cf0e5313168000"},"cipher":"aes-128-ctr","kdf":"scrypt","kdfparams":{"dklen":32,"salt":"f5c055306fe759ca2b1273667c6a005c8d0d6981f50a069766bc96fdc0822733","n":131072,"r":8,"p":1},"mac":"c0f9d19122b4b7482ff2af27f796154ec471504d8eda9450c7a44751b640f49a"}}