
{{ content() }}

<div align="right">
    {{ link_to("masclasslevel/new", "เพิ่มข้อมูลระดับการศึกษา", "class": "btn btn-primary") }}
</div>

{{ form("masclasslevel/search") }}

<h2>ค้นหาข้อมูลระดับการศึกษา</h2>

<fieldset>

{% for element in form %}
    {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
{{ element }}
    {% else %}
<div class="control-group">
    {{ element.label(['class': 'control-label']) }}
    <div class="controls">
        {{ element }}
    </div>
</div>
    {% endif %}
{% endfor %}

<div class="control-group">
    {{ submit_button("ค้นหา", "class": "btn btn-primary") }}
</div>

</fieldset>

</form>

