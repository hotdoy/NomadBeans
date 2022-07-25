---
title: Submit
form:
    name: submit-form
    attributes:
        x-data: submitFormComponent
    fields:
        your_details:
            type: section
            title: 'Your Details'
            title_level: h2
            classes: 'mb-4 mt-8'
        name:
            type: text
            id: name
            label: Name
            label_classes: label
            label_element_classes: label-text
            outerclasses: 'mb-4 form-control w-full'
            classes: 'input input-bordered w-full'
            validate:
                required: true
        email:
            type: email
            id: email
            label: Email
            label_classes: label
            label_element_classes: label-text
            placeholder: example@example.com
            outerclasses: 'form-control w-full mb-4'
            classes: 'input input-bordered w-full'
            validate:
                required: true
        message:
            type: textarea
            id: message
            label: 'Message (Optional)'
            label_element_classes: label-text
            placeholder: 'Enter a message'
            classes: 'textarea textarea-bordered h-24 w-full'
            outerclasses: ' form-control mb-4'
            label_classes: label
            maxlength: 255
        is_affilitated:
            type: checkbox
            id: is-affiliated
            label: 'I am working for or are affiliated with this cafe.'
            outerclasses: mb-4
        cafe_details:
            type: section
            title: 'Cafe Details'
            title_level: h2
            classes: 'mb-4 mt-8'
        cafe_name:
            type: text
            id: cafe-name
            label: 'Cafe Name'
            label_classes: label
            label_element_classes: label-text
            outerclasses: 'mb-4 form-control w-full'
            classes: 'input input-bordered w-full'
            validate:
                required: true
        cafe_description:
            type: textarea
            id: cafe-description
            label: 'Cafe Description'
            label_element_classes: label-text
            placeholder: 'Enter a description (Max 500 characters)'
            classes: 'textarea textarea-bordered h-24 w-full'
            outerclasses: ' form-control mb-4'
            label_classes: label
            maxlength: 500
            validate:
                required: true
        cafe_images:
            type: file
            id: cafe-images
            label: Images
            display_label: true
            label_classes: label
            label_element_classes: label-text
            outer_label_classes: test
            multiple: true
            classes: '!mb-0'
            destination: self@
            random_name: false
            avoid_overwriting: true
            outerclasses: 'form-control mb-4'
            filesize: 3
            limit: 10
            accept:
                - 'image/*'
        cafe_country:
            type: select
            id: cafe-country
            default: US
            label: Country
            label_classes: label
            label_element_classes: label-text
            outerclasses: 'form-control mb-4'
            classes: 'select select-bordered w-full'
            size: long
            data-options@: '\Grav\Plugin\Gravel\Utils::getCountries'
        cafe_city:
            type: select
            id: cafe-city
            label: City
            label_classes: label
            label_element_classes: label-text
            outerclasses: 'form-control mb-4'
            classes: 'select select-bordered w-full'
            size: long
            options:
                default: 'Select a country to view cities.'
        cafe_lat:
            type: text
            id: cafe-lat
            label: 'Cafe Latitude'
            label_classes: label
            label_element_classes: label-text
            classes: 'input input-bordered w-full'
            outerclasses: 'mb-4 form-control w-full'
        cafe_lng:
            type: text
            id: cafe-lng
            label: 'Cafe Longitude'
            label_classes: label
            label_element_classes: label-text
            classes: 'input input-bordered w-full'
            outerclasses: 'mb-4 form-control w-full'
        cafe_rating_coffee:
            type: range
            id: cafe-rating-coffee
            label: 'How is the coffee?'
            label_classes: label
            label_element_classes: label-text
            classes: 'range range-primary'
            outerclasses: 'mb-4 form-control w-full'
            validate:
                min: 0
                max: 10
        cafe_rating_wifi:
            type: range
            id: cafe-rating-coffee
            label: 'How is the Wi-Fi?'
            label_classes: label
            label_element_classes: label-text
            classes: 'range range-primary'
            outerclasses: 'mb-4 form-control w-full'
            validate:
                min: 0
                max: 10
        cafe_rating_price:
            type: range
            id: cafe-rating-coffee
            label: 'How is the price?'
            label_classes: label
            label_element_classes: label-text
            classes: 'range range-primary'
            outerclasses: 'mb-4 form-control w-full'
            validate:
                min: 0
                max: 10
        cafe_rating_seating:
            type: range
            id: cafe-rating-coffee
            label: 'How is the seating?'
            label_classes: label
            label_element_classes: label-text
            classes: 'range range-primary'
            outerclasses: 'mb-4 form-control w-full'
            validate:
                min: 0
                max: 10
        cafe_rating_food:
            type: range
            id: cafe-rating-coffee
            label: 'How is the food?'
            label_classes: label
            label_element_classes: label-text
            classes: 'range range-primary'
            outerclasses: 'mb-4 form-control w-full'
            validate:
                min: 0
                max: 10
        cafe_rating_location:
            type: range
            id: cafe-rating-coffee
            label: 'How is the location?'
            label_classes: label
            label_element_classes: label-text
            classes: 'range range-primary'
            outerclasses: 'mb-4 form-control w-full'
            validate:
                min: 0
                max: 10
        cafe_amenities:
            type: text
            label: Features
            id: cafe-amenities
            display_label: false
            outerclasses: form-control
            size: large
            classes: fancy
            help: PLUGIN_ADMIN.TAXONOMY_TYPES_HELP
            validate:
                type: commalist
        g-recaptcha-response:
            label: Captcha
            type: captcha
            recaptcha_not_validated: 'Captcha not valid!'
            classes: 'mx-auto max-w-max'
            outerclasses: 'mx-auto max-w-max my-8'
    buttons:
        reset:
            type: reset
            value: Reset
            classes: 'btn btn-ghost mr-4'
        submit:
            type: submit
            value: Submit
            classes: 'btn btn-primary btn-wide'
    process:
        captcha: true
        email:
            from: '{{ config.plugins.email.from }}'
            to:
                - '{{ config.plugins.email.to }}'
                - '{{ form.value.email }}'
            subject: '[Feedback] {{ form.value.name|e }}'
            body: '{% include ''forms/data.html.twig'' %}'
        save:
            fileprefix: feedback-
            dateformat: Ymd-His-u
            extension: txt
            body: '{% include ''forms/data.txt.twig'' %}'
        message: 'Thank you for your feedback!'
        display: thankyou
page_media_alt_desc: 'a woman making coffee at a counter inside a cafe'
media_order: nafinia-putra-Kwdp-0pok-I-unsplash.jpeg
access:
    site:
        submit: true
---

