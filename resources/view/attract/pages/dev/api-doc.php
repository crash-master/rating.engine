<? vjoin('attract/layouts/header') ?>

<div class="container">
	<section class="page" id="api-doc">
		<h2 class="block-title">Документация API</h2>
		<p>Использовать наш API очень просто. Мы используем передачу данных по http<strong>, </strong>и в ответ отдаём обычный json.</p><p>Вы можете получить иформацию о <strong>профиле</strong> воспользовавшись следующим http запросом:</p><p><em>http://astralmagic.ru/api/v1/<strong>{api_key}</strong>/profile/<strong>{slug_or_id}&nbsp;</strong></em></p><p>Где&nbsp;<em style="font-weight: bolder;">{api_key}</em> - это ваш <a href="/dev/page/new-api-key">ключ API</a>, его можно получить <a href="/dev/page/new-api-key">тут</a>,&nbsp;<em style="font-weight: bolder;">{slug_or_id} </em>- slug или id мага данные о котором вы хотите получить.</p><p>Пример на языке PHP:</p>

<blockquote><ol><li><font color="#000000">&lt;?php</font>&nbsp;</li><li>&nbsp;</li><li><font color="#666666">//&nbsp;ваш&nbsp;ключ&nbsp;API</font></li><li><font color="#000088">$api_key</font>&nbsp;<font color="#339933">=</font>&nbsp;<font color="#0000ff">"d8defe0fe400f183a5f4aca4b032a516c0c9c5253babd7b9c8fb4648d214006659bce176f641d70d"</font><font color="#339933">;</font></li><li>&nbsp;</li><li><font color="#666666">//&nbsp;slug&nbsp;или&nbsp;id&nbsp;мага</font></li><li><font color="#000088">$slug</font>&nbsp;<font color="#339933">=</font>&nbsp;<font color="#0000ff">"damir"</font><font color="#339933">;</font></li><li>&nbsp;</li><li><font color="#666666">//&nbsp;выполнение&nbsp;http&nbsp;запроса</font></li><li><font color="#000088">$json</font>&nbsp;<font color="#339933">=</font>&nbsp;<font color="#990000">file_get_contents</font><font color="#009900">(</font><font color="#0000ff">"http://astralmagic.ru/api/v1/<font color="#006699">{$api_key}</font>/profile/<font color="#006699">{$slug}</font>"</font><font color="#009900">)</font><font color="#339933">;</font></li><li>&nbsp;</li><li><font color="#666666">//&nbsp;декодирование&nbsp;json&nbsp;данных</font></li><li><font color="#000088">$data</font>&nbsp;<font color="#339933">=</font>&nbsp;<font color="#990000">json_decode</font><font color="#009900">(</font><font color="#000088">$json</font><font color="#009900">)</font><font color="#339933">;</font></li><li>&nbsp;</li><li><font color="#666666">//&nbsp;вывод&nbsp;результата&nbsp;на&nbsp;экран</font></li><li><font color="#b1b100">echo</font><font color="#009900">(</font><font color="#0000ff">"&lt;pre&gt;"</font><font color="#009900">)</font><font color="#339933">;</font></li><li><font color="#990000">var_dump</font><font color="#009900">(</font><font color="#000088">$data</font><font color="#009900">)</font><font color="#339933">;</font></li><li><font color="#b1b100">echo</font><font color="#009900">(</font><font color="#0000ff">"&lt;/pre&gt;"</font><font color="#009900">)</font><font color="#339933">;</font></li><li>&nbsp;</li><li><font color="#000000">?&gt;</font></li></ol><p><font color="#000000"></font></p>
	<p><font color="#000000">Ответ на запрос:</font></p><p><font color="#000000"></font></p></blockquote>

<blockquote><ol><li><font color="#009900">{</font></li><li>&nbsp;&nbsp;<font color="#3366CC">"status"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"success"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;<font color="#3366CC">"result"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"profile"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"id"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">20</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"site"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"mag-damir.ru"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"name"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"Дамир"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"slug"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"damir"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"contacts"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"Телейон:&nbsp;+7&nbsp;(916)&nbsp;403-41-27&nbsp;Эл.почта&nbsp;-&nbsp;magister.damir@gmail.com"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"count_views"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">7</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"rating"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"good"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">0</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"bad"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">0</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"neutral"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">0</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"total"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">0</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"rating_value"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">0</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"date_of_create"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"2018-10-15&nbsp;23:19:43"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"category"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"id"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">10</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"title"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"Маг"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"timestamp"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"2018-09-24&nbsp;23:15:13"</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"site_url"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"http://astralmagic.ru/redirect/original-url/20"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"url_to_profile"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"http://astralmagic.ru/profile/damir"</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"last_reviews"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font>&nbsp;<font color="#009900">[</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"id"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">42</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"username"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"John&nbsp;Doe"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"message"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"image_src"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"data:image/png;base64..."</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"text"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"Lorem&nbsp;ipsum"</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"image"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">""</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"date_of_create"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"2018-10-16&nbsp;19:56:39"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"rating_weight"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"-1"</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"id"</font><font color="#339933">:</font>&nbsp;<font color="#CC0000">26</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"username"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"Mike&nbsp;Tiger"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"message"</font><font color="#339933">:</font>&nbsp;<font color="#009900">{</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"image_src"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">""</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"text"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"Lorem&nbsp;ipsum&nbsp;2"</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"image"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">""</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"date_of_create"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"2018-09-21&nbsp;11:49:11"</font><font color="#339933">,</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#3366CC">"rating_weight"</font><font color="#339933">:</font>&nbsp;<font color="#3366CC">"1"</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font>&nbsp;<font color="#009900">]</font></li><li>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#009900">}</font></li><li>&nbsp;&nbsp;<font color="#009900">}</font></li><li><font color="#009900">}</font></li></ol></blockquote><p>

Всего существует 2 запроса:</p><p><em>http://astralmagic.ru/api/v1/</em><strong>{api_key}</strong><em>/profile/</em><em style="font-weight: bolder;">{slug_or_id} </em>- получить информацию об одном маге</p><p><em>http://astralmagic.ru/api/v1/<strong>{api_key}</strong>/high-profiles</em><em style="font-size: 1rem;"> </em>- получить список лучших магов на сайте, сортированых по рейтингу</p>
	</section>
</div>

<? vjoin('Footer') ?>