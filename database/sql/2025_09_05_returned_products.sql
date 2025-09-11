-- SEQUENCE: public.returned_id_seq

-- DROP SEQUENCE IF EXISTS public.returned_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.returned_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

-- Table: public.returned_products

-- DROP TABLE IF EXISTS public.returned_products;

CREATE TABLE IF NOT EXISTS public.returned_products
(
    id bigint NOT NULL DEFAULT nextval('returned_id_seq'::regclass),
    invoice_no character varying(20) COLLATE pg_catalog."default",
    product_id bigint NOT NULL,
    transaction_id bigint NOT NULL,
    returned_date date NOT NULL,
    quantity integer NOT NULL,
    unit_price decimal(10, 2) NOT NULL,
    amount decimal(10, 2) NOT NULL,
    reason text NOT NULL,
    division bigint NOT NULL,
    created_by_id bigint NOT NULL,
    updated_by_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT returned_products_pkey PRIMARY KEY (id),
    CONSTRAINT returned_products_created_by_id_foreign FOREIGN KEY (created_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT returned_products_division_foreign FOREIGN KEY (division)
    REFERENCES public.system_l_o_v_s (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT returned_products_updated_by_id_foreign FOREIGN KEY (updated_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION
    )

    TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.returned_products
    OWNER to postgres;

ALTER SEQUENCE public.returned_id_seq
    OWNED BY public.returned_products.id;

ALTER SEQUENCE public.returned_id_seq
    OWNER TO postgres;
