<div class="report-modal">
    <h1 class="title-list">Report</h1>
    <form action="{{route}}" method="post" class="report-form">
    	<div class="field">
            <label for="content">Nội dung</label>
            <input type="hidden" class="episode_id" name="episode_id" value="{{episode_id}}">
            <p class="control ">
                <input class="input report-content" type="text" name="content">
            </p>
        </div>
        <div class="field">
            <p class="control">
                <button class="button is-success" type="submit" name="submit" ">
                    Gửi
                </button>
            </p>
        </div>
    </form>
</div>
