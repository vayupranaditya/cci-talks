		<p class="
			has-text-centered 
			<?php if(strtolower($model['info'])==='student id not found'){echo 'has-text-danger';} ?>
			">
			<?php echo $model['info'] ?>
		</p>
		<div style="height:2vh">
		</div>
		<div class="field is-centered is-mobile">
			<form action="/cci-talks/talks/" method="POST" name="login">
				<div class="control">
					<input class="input has-text-centered" type="text" placeholder="Student ID" name="nim" autofocus="autofocus"
					onkeypress="return (event.charCode>47 & event.charCode<58) || (event.charCode==13)"/>
					<input type="submit" value="Next" name="next" hidden="hidden"/>
				</div>
				<div style="height:2vh">
				</div>
				<a class="button is-hidden-desktop is-fullwidth is-link" onclick="document.login.submit()">
					Next
				</a>
			</form>
		</div>