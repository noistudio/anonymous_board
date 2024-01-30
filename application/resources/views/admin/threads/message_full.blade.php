<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-5">
                @if($name=$thread->getName())
                    <b>{{ $name }}</b>
                @else
                    <b>Анонимус</b>
                @endif
            </div>
            <div class="col-7">
                {{ $thread->getCreatedAt() }}
            </div>
        </div>
        <div class="col-12">
            @include("web.components.editorjs_render",["json"=>$thread->getContentJSON()])
        </div>
        <div class="row mt-2">

            <div class="col-4">
                @if($thread->getId()!=$thread->getThreadId())
                   <a href="{{ route('admin.threads.delete_message',$thread->getId()) }}">Удалить Сообщение</a>

                @endif


            </div>
            <div class="col-4">
                Ответов {{ $thread->getCountResponsible() }}
            </div>
        </div>
        <div class="row mt-2">
            <form action="{{ route('admin.threads.addban') }}" method="POST">
                <table class="table">
                  <tr>
                      <td>На каких досках?</td>
                      <td><select class="form-control" name="board_id">
                              <option value="0">на всех</option>
                              <option value="{{$thread->getBoardId()}}">на этой</option>
                          </select></td>
                  </tr>
                  <tr>
                      <td>бан до</td>
                      <td><input type="datetime-local" name="date_to" class="form-control" required></td>
                  </tr>
                  <tr>
                       <td><input type="hidden" name="hash" value="{{ $thread->getHash() }}">
                       {{ csrf_field() }}</td>
                       <td><button type="submit" class="btn btn-success">Забанить</button></td>
                  </tr>
                </table>
            </form>
        </div>
    </div>
</div>

