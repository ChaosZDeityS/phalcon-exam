
{{ form("teacher/save", 'role': 'form'  ) }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("teacher", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}
        {{ stylesheet_link('css/indexTeacherEdit.css') }}

<h2>แก้ไขข้อมูลอาจารย์</h2>

<fieldset>

{% for element in form %}
    {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
{{ element }}
    {% else %}
<div class="form-group">
    {{ element.label(['class': 'control-label']) }}
    <div class="controls">
        {{ element }}
    </div>
</div>
    {% endif %}
{% endfor %}

</fieldset>

</form>
{{ javascript_include('js/teacherEdit.js') }}
