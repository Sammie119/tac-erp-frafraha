-- Products
ALTER TABLE IF EXISTS public.products
    ADD COLUMN sku character varying(20),
    ADD COLUMN is_material smallint DEFAULT '0'::smallint;

-- Transaction Details
ALTER TABLE IF EXISTS public.transaction_details
    ADD COLUMN product_description character varying(500);

-- Transaction
ALTER TABLE IF EXISTS public.transactions
    ADD COLUMN transaction_state character varying(20);

-- Staff
ALTER TABLE IF EXISTS public.staff
    ADD COLUMN ssnit_number character varying(20),
    ADD COLUMN employment_date date,
    ADD COLUMN salary_grade character varying(20),
    ADD COLUMN entry_qualification character varying(100),
    ADD COLUMN current_qualification character varying(100),
    ADD COLUMN emergency_person character varying(100),
    ADD COLUMN emergency_contact character varying(20);


-- View: public.vw_staff

DROP VIEW public.vw_staff;

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
       division,
       ssnit_number,
       employment_date,
       salary_grade,
       entry_qualification,
       current_qualification,
       emergency_person,
       emergency_contact,
       created_by_id,
       updated_by_id,
       created_at,
       updated_at,
       deleted_at
FROM staff
WHERE deleted_at IS NULL;

