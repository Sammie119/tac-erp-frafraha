-- SEQUENCE: public.prod_id_seq

-- DROP SEQUENCE IF EXISTS public.prod_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.prod_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

-- Table: public.old_products_stocks

-- DROP TABLE IF EXISTS public.old_products_stocks;

CREATE TABLE IF NOT EXISTS public.old_products_stocks
(
    id bigint NOT NULL DEFAULT nextval('prod_id_seq'::regclass),
    product_id bigint NOT NULL,
    stock_date date NOT NULL,
    stock_in integer NOT NULL,
    stock_out integer NOT NULL,
    division bigint NOT NULL,
    created_by_id bigint NOT NULL,
    updated_by_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT old_products_stocks_pkey PRIMARY KEY (id),
    CONSTRAINT old_products_stocks_created_by_id_foreign FOREIGN KEY (created_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT old_products_stocks_division_foreign FOREIGN KEY (division)
    REFERENCES public.system_l_o_v_s (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT old_products_stocks_updated_by_id_foreign FOREIGN KEY (updated_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION
    )

    TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.old_products_stocks
    OWNER to postgres;

ALTER SEQUENCE public.prod_id_seq
    OWNED BY public.old_products_stocks.id;

ALTER SEQUENCE public.prod_id_seq
    OWNER TO postgres;
