<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\clEPNAPIAccess\clEPNAPIAccess;

class EPNController extends Controller
{
    public function getEPNGoods() {
        $apiKey = 'fb6690ae952d917191e353c967ba14b4';
        $userHash = 'rxzxn5dnbt26hzh7fwozqwioyt1g249o';
        $requests_to_process = [
            'action' => 'categories_list_1',
        ];
        $categories = array();
        $topPhones = array();

        $epn = new clEPNAPIAccess($apiKey, $userHash);

        // Добавляем запрос на получение списка категорий
        $epn->AddRequestCategoriesList('categories_list_1');

        // Добавляем запрос на получение топовых товаров из категории телефоны
        $epn->AddRequestGetTopMonthly('top_phones_sales_1', 'ru', 'RUR,UAH,USD', 'sales', '509');

        if ($epn->RunRequests()) {
            // Извлекаем список категорий
            if (($categories_tmp = $epn->GetRequestResult('categories_list_1')) && isset($categories_tmp['categories'])) {
                $categories = $categories_tmp['categories'];
            }
            // Извлекаем список топовых товаров категории телефоны
            if (($topPhones_tmp = $epn->GetRequestResult('top_phones_sales_1'))) {
                $topPhones = $topPhones_tmp['offers'];
            }
        } else {
            return response()->json($epn->LastError());
        }

        $data = $categories + $topPhones;

        // Возвращаем данные в вашем формате
        return response()->json($data);
    }
}
