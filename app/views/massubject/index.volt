
{{ content() }}

<div align="right">
    {{ link_to("massubject/new", "เพิ่มรายวิชา", "class": "btn btn-primary") }}
</div>

{{ form("massubject/search") }}

<h2>ค้นหารายวิชา</h2>

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
