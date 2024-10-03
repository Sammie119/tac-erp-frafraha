-- View: public.vw_transactions

-- DROP VIEW public.vw_transactions;

CREATE OR REPLACE VIEW public.vw_transactions
 AS
SELECT transaction_id,
       invoice_no,
       customer_id,
       get_customer_name(customer_id) AS customer_name,
       transaction_date,
       without_tax_amount,
       taxable,
       nhil,
       gehl,
       covid19,
       vat,
       transaction_amount,
       get_transaction_balance(transaction_id) AS amount_paid,
       round(COALESCE(transaction_amount::numeric - get_transaction_balance(transaction_id)::numeric, 0.00), 2) AS balance,
       CASE
           WHEN COALESCE(transaction_amount::numeric - get_transaction_balance(transaction_id)::numeric, 0.00) = 0::numeric THEN 'Paid'::text
            WHEN COALESCE(transaction_amount::numeric - get_transaction_balance(transaction_id)::numeric, 0.00) = transaction_amount THEN 'Not Started'::text
            ELSE 'Paying'::text
       END AS status,
        division,
        created_by_id,
        updated_by_id,
        created_at,
        updated_at,
        deleted_at
   FROM transactions
  WHERE deleted_at IS NULL;

ALTER TABLE public.vw_transactions
    OWNER TO postgres;

