<p class="has-text-centered">
	<?php echo $model['info'] ?>
</p>
<div style="height:2vh">
</div>
<div class="field is-centered is-mobile">
	<form action="/cci-talks/talks/" method="GET" name="login">
		<div class="control">
			<input class="input has-text-centered" type="text" placeholder="Student ID" name="nim" autofocus="autofocus"/>
        </div>
		<div style="height:2vh">
		</div>
        <a class="button is-hidden-desktop is-fullwidth is-link" onclick="document.login.submit()">
			Login
        </a>
    </form>
</div>