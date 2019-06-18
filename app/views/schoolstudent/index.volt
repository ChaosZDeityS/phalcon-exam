
{{ content() }}
        {{ stylesheet_link('css/indexSchoolStudent.css') }}

<div align="right">
    {{ link_to("schoolstudent/new", "เพิ่มข้อมูลนักเรียน", "class": "btn btn-primary") }}
</div>

{{ form("schoolstudent/search") }}

<h2>ค้นหาข้อมูลนักเรียน</h2>

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

        {{ javascript_include('js/schoolstudent.js') }}


