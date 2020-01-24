# Шпаргалка комманд консоли


## Установка через composer

````
composer create-project --prefer-dist laravel/laravel=версия папка
````

## Плагины для PhpStorm
- Laravel Plugin

## Пакеты без которых жизнь не мила:
- https://github.com/barryvdh/laravel-debugbar
- https://github.com/barryvdh/laravel-ide-helper

## Создание моделей 

```
php artisan make:model Model/BlogCategory -m

php artisan make:model Model/BlogPost -m<
```
## Создание БД для Laravel

````
create schema `poligon` default character set utf8mb4 collate utf8mb4_unicode_ci;
````

## Миграция 

````
php artisan migrate
````

## Создание сидеров, фабрик

```
php artisan make:seeder UserTableSeeder

php artisan make:seeder BlogCategoriesTableSeeder
```

Запуск сидов

```

php artisan db:seed
php artisan db:seed --class=UserTableSeeder
php artisan migrate:refresh --seed

```

Содание фабрики

```

php artisan make:factory BlogPostFactory --model="App\Models\BlogPost"

```

При создании новых сидов полезно делать 

```

composer dumpautoload

```

## Контроллеры

Создание

```

php artisan make:controller RestTestController --resource

```

Аутентификация (для базовой вёрстки)
```
php artisan make:auth
php artisan migrate
```

## Примеры выборки
```
        $item = BlogCategory::findOrFail($id);
//        $item = BlogCategory::find($id);
//        $item []= BlogCategory::findOrFail($id);
//        $item []= BlogCategory::where('id','=' ,$id)->first();
//        $item []= BlogCategory::where('id','=' ,$id)->get(); // возвращает array
//        $item []= BlogCategory::where('id', $id)->first();
//        dd($item);
```

## Создание своего Request

```
php artisan make:request BlogCategoryUpdateRequest
```

## Говнокод для валидации в контроллере

```
    use Illuminate\Foundation\Validation\ValidatesRequests;

//        $rules = [
//          'title' => 'required|min:5|max:200',
//          'slug' => 'max:191',
//          'description' => 'string|min:3|max:500',
//          'parent_id' => 'required|integer|exists:blog_categories,id',
//        ];

//        $validatedData = $this->validate($request, $rules);

//        $validatedData = $request->validate($rules);

     /*   $validator = \Validator::make($request->all(), $rules);

        $validatedData [] = $validator->passes();
        $validatedData [] = $validator->validate();
        $validatedData [] = $validator->valid();
        $validatedData [] = $validator->failed();
        $validatedData [] = $validator->errors();
        $validatedData [] = $validator->fails();

        dd($validatedData);

        */
```


## Сохранение объекта

```
//        $item = BlogCategory($data);
//        $item->save();

        $item = (new BlogCategory())->create($data);
```

## Примеры запросов

```
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title'
        ]);

//        $result [] = $this->startConditions()->all();
//        $result [] = $this
//            ->startConditions()
//            ->select('blog_categories.*',
//                DB::raw('CONCAT (id, ". ", title) AS id_title'))
//            ->toBase()
//            ->get();

        $result [] = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

```