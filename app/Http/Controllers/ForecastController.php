<?php


namespace App\Http\Controllers;
use App\Forecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{
    public function show(Request $request) {
        $forecast = Forecast::where('city', $request->city)
            ->orderBy('actual_time', 'desc') //сортируем по времени актуальности в обратном порядке, получается выборка
            ->first(); //из этой выборки получаем первый элемент
        return view('forecast/show', ['forecast' => $forecast]);
        //echo "Город {$forecast->city}, погода {$forecast->degrees}";
        //echo $request->city;
    }

    public function setFromApi(Request $request) {
        $response = Http::get('http://api.weatherapi.com/v1/current.json', [
            'key' => 'd3fa7446ae4f41bc81d144648211604',
            'q' => $request->city,
            'aqi' => 'no'
        ]); //делаем запрос на удалённый сервер
        $data = $response->json(); //преобразуем в массив его json-ответ
        //Создаём новый объект класса Forecast и заполняем его данным
        $forecast = new Forecast();
        $forecast->city = $request->city;
        $forecast->degrees = $data['current']['temp_c'];
        $forecast->image = $data['current']['condition']['icon'];
        $forecast->actual_time = $data['current']['last_updated'];
        //если сохранение прошло успешно, $forecast->save() вернёт true
        if($forecast->save()) {
            echo 'Новые данные успешно добавлены в базу';
        } else {
            echo 'Не удалось добавить новые данные ((';
        }
    }
}
