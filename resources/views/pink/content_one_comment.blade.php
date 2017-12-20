<li id="li-comment-{{$data['id']}}" class="comment even borGreen">
    <div id="comment-{{$data['id']}}" class="comment-container">
        <div class="comment-author vcard">
            <img alt="" src="https://www.gravatar.com/avatar/{{$data['hash']}}"/>
            <cite class="fn">{{$data['name']}}</cite>
        </div>

        <div class="comment-meta commentmetadata">
            <div class="intro">

            </div>
            <div class="comment-body">
                <p>{{$data['text']}}</p>
            </div>
        </div>
    </div>
</li>