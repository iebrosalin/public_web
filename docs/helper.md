# Шпаргалка на основе курса


## Установка через composer

````
composer create-project --prefer-dist laravel/laravel=версия папка
````

## Плагины для PhpStorm
- Laravel Plugin

## Пакеты без которых жизнь не мила:
```
composer require barryvdh/laravel-debugbar --dev
composer require --dev barryvdh/laravel-ide-helper
```


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


## Отношения

Объявление отношения в классе

```
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = [
        'published_at'
    ];
}

```

Жадная загрузка

```
    public function getAllWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
//            ->with(['category', 'user'])
            ->with(
                [
                    'category' => function($query) {
                        $query->select(['id', 'title']);
                    },
                    'user:id,name'
                ]
            )
            ->paginate($perPage);

        return $result;
    }
```

Ленивая загрузка

```
 <td>{{ $post->user->name }}</td>
 <td>{{ $post->category->title }}</td>
```

## Observers

Создание

```
php artisan make:observer BlogPostObserver --model=Models\BlogPost
php artisan make:observer BlogCategoryObserver --model=Models\BlogCategory
```

Полезные методы для работы в обсервере

```
        $test[] = $blogPost->isDirty();
//        $test[] = $blogPost->isDirty('is_published');
//        $test[] = $blogPost->isDirty('user_id');
//        $test[] = $blogPost->getAttribute('is_published');
//        $test[] = $blogPost->is_published;
//        $test[] = $blogPost->getOriginal('is_published');
//        dd($test)
```

    /**
     * Перед созданием поста
     *
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost)
    {
//        $this->setPublishedAt($blogPost);
//
//        $this->setSlug($blogPost);
    }

    /**
     * Перед обновлением поста
     *
     * @param BlogPost $blogPost
     */

    public function updating(BlogPost $blogPost)
    {
        dd($blogPost);

        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }

    protected function  setPublishedAt(BlogPost $blogPost)
    {
        $flagSetPublishAt = empty($blogPost->published_at) && $blogPost->is_published;

        if($flagSetPublishAt){
            $blogPost->published_at = Carbon::now();
        }
    }

    protected function  setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }
