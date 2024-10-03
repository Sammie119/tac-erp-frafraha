-- View: public.vw_staff

-- DROP VIEW public.vw_staff;

CREATE OR REPLACE VIEW public.vw_staff
 AS
SELECT staff_id,
       staff_number,
       title,
       get_lov_name(title::bigint) AS ttile_name,
       gender,
       get_lov_name(gender::bigint) AS gender_name,
       firstname,
       othernames,
       concat(get_lov_name(title::bigint), ' ', firstname, ' ', othernames) AS full_name,
       date_of_birth,
       date_part('year'::text, age(date_of_birth::timestamp with time zone)) AS age,
       married,
       get_lov_name(married::bigint) AS married_name,
       phone,
       email,
       address,
       "position",
       get_lov_name("position"::bigint) AS position_name,
       banker,
       bank_account,
       bank_branch,
       bank_sort_code,
       ghana_card,
       created_by_id,
       updated_by_id,
       created_at,
       updated_at,
       deleted_at
FROM staff
WHERE deleted_at IS NULL;

ALTER TABLE public.vw_staff
    OWNER TO postgres;

