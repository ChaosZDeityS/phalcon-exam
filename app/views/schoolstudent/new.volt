
{{ content() }}
        {{ stylesheet_link('css/indexSchoolStudentNew.css') }}

{{ form("schoolstudent/create") }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("schoolstudent", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {{ submit_button("Save", "class": "btn btn-success") }}
        </li>
    </ul>

    <fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div class="form-group">
                {{ element.label() }}
                {{ element.render(['class': 'form-control']) }}
            </div>
        {% endif %}
    {% endfor %}

    </fieldset>

</form>

{{ javascript_include('js/schoolstudentNew.js') }}
