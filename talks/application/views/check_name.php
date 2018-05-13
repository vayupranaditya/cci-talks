		<p class="has-text-centered">
			<?php echo $model['info'] ?>
		</p>
		<div style="height:2vh">
		</div>
		<p class="has-text-centered">
			Is it you?
		</p>
		<div style="height:1vh">
		</div>
		<form action="/cci-talks/talks/index.php/Success" method="POST" name="login">
			<div class="field is-centered is-mobile">
				<input type="text" value="<?php echo $model['nim']?>" hidden="hidden" name="nim"/>
				<a class="button is-fullwidth is-link" onclick="document.login.submit()">
					Yes
				</a>
				<div style="height:1vh">
				</div>
				<a class="button is-fullwidth is-text" onclick="window.location='/cci-talks/talks/'">
					No
				</a>
			</div>
		</form>