@php /**  @var \App\Models\BlogCategory $item */ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликованно
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a href="#adddata" class="nav-link" data-toggle="tab" role="tab">Дополнительные
                            данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">

                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title', $item->title) }}" id="title"
                                   minlength="3" required>
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw"
                                      id="content_raw"
                                      rows="20"
                                      class="form-control">{{old('content_raw',$item->content_raw)}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select type="text" class="form-control" name="category_id"
                                    value="{{ old('category_id',$item->category_id) }}"
                                    id="category_id" placeholder="Выберите категорию" required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{$categoryOption->id}}"
                                            @if($categoryOption->id == $item->category_id) selected @endif>
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text"
                                   class="form-control"
                                   name="slug"
                                   value="{{ old('slug',$item->slug) }}"
                                   id="slug">
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <input type="text"
                                   class="form-control"
                                   name="excerpt"
                                   value="{{ old('excerpt',$item->excerpt) }}"
                                   id="excerpt"
                            >
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox"
                                   name="is_published"
                                   value="1"
                                   class="form-check-input"
                                   @if($item->is_published)
                                   checked="checked"
                                   @endif
                            >
                            <label for="us_published" class="form-check-label">опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>