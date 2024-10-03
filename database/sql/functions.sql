-- FUNCTION: public.get_lov_name(bigint)

-- DROP FUNCTION IF EXISTS public.get_lov_name(bigint);

CREATE OR REPLACE FUNCTION public.get_lov_name(
	p_id bigint)
    RETURNS character varying
    LANGUAGE 'sql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
SELECT name FROM public.system_l_o_v_s
WHERE id = p_id;

$BODY$;

ALTER FUNCTION public.get_lov_name(bigint)
    OWNER TO postgres;


-- FUNCTION: public.get_staff_name(bigint)

-- DROP FUNCTION IF EXISTS public.get_staff_name(bigint);

CREATE OR REPLACE FUNCTION public.get_staff_name(
	p_staff_id bigint)
    RETURNS character varying
    LANGUAGE 'sql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
SELECT full_name FROM public.vw_staff
WHERE staff_id = p_staff_id;

$BODY$;

ALTER FUNCTION public.get_staff_name(bigint)
    OWNER TO postgres;


-- FUNCTION: public.get_customer_name(bigint)

-- DROP FUNCTION IF EXISTS public.get_customer_name(bigint);

CREATE OR REPLACE FUNCTION public.get_customer_name(
	p_id bigint)
    RETURNS character varying
    LANGUAGE 'sql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
SELECT name FROM public.customers
WHERE id = p_id;

$BODY$;

ALTER FUNCTION public.get_customer_name(bigint)
    OWNER TO postgres;


-- FUNCTION: public.get_transaction_balance(bigint)

-- DROP FUNCTION IF EXISTS public.get_transaction_balance(bigint);

CREATE OR REPLACE FUNCTION public.get_transaction_balance(
	p_id bigint)
    RETURNS character varying
    LANGUAGE 'sql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
SELECT round(COALESCE(sum(amount_paid), 0.00), 2) as paid FROM public.transaction_payments
WHERE transaction_id = p_id;

$BODY$;

ALTER FUNCTION public.get_transaction_balance(bigint)
    OWNER TO postgres;


