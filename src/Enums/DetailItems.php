<?php


namespace StephenHarris\QIF\Enums;


/**
 * Class DetailItems
 *
 * @author MimoGraphix <mimographix@gmail.com>
 * @copyright EpicFail | Studio
 * @package StephenHarris\QIF\Enums
 */
class DetailItems
{
    // All
    const D	    = "D";      // Date. Leading zeroes on month and day can be skipped. Year can be either 4 digits or 2 digits or '6 (=2006).	All	D25 December 2006
    const T	    = "T";      // Amount of the item. For payments, a leading minus sign is required. For deposits, either no sign or a leading plus sign is accepted. Do not include currency symbols ($, £, ¥, etc.). Comma separators between thousands are allowed.	All	T-1,234.50
    const U	    = "U";      // Seems identical to T field (amount of item.) Both T and U are present in QIF files exported from Quicken 2015.	All	U-1,234.50
    const M	    = "M";      // Memo—any text you want to record about the item.	All	Mgasoline for my car
    const C	    = "C";      // Cleared status. Values are blank (not cleared), "*" or "c" (cleared) and "X" or "R" (reconciled).	All	CR

    // Banking, Splits, Investment
    const N	    = "N";      // Number of the check. Can also be "Deposit", "Transfer", "Print", "ATM", "EFT".	Banking, Splits	N1001

    // Banking, Splits
    const A	    = "A";      // Address of Payee. Up to 5 address lines are allowed. A 6th address line is a message that prints on the check. 1st line is normally the same as the Payee line—the name of the Payee.	Banking, Splits	A101 Main St.
    const L	    = "L";      // Category or Transfer and (optionally) Class. The literal values are those defined in the Quicken Category list. SubCategories can be indicated by a colon (":") followed by the subcategory literal. If the Quicken file uses Classes, this can be indicated by a slash ("/") followed by the class literal. For Investments, MiscIncX or MiscExpX actions, Category/class or transfer/class. (40 characters maximum)	Banking, Splits	LFuel:car

    // Banking, Investment
    const P	    = "P";      // Payee. Or a description for deposits, transfers, etc.	Banking, Investment	PStandard Oil, Inc.

    // Banking
    const F	    = "F";      // Flag this transaction as a reimbursable business expense.	Banking	F???

    // Investment, Splits
    const AMNT  = "$";      // Amount for this split of the item. Same format as T field.	Splits	$1,000.50

    // Split
    const S	    = "S";      // Split category. Same format as L (Categorization) field. (40 characters maximum)	Splits	Sgas from Esso
    const E	    = "E";      // Split memo—any text to go with this split item.	Splits	Ework trips
    const PERC	= "%";      // Percent. Optional—used if splits are done by percentage.	Splits	%50

    // Investment
    const Y	    = "Y";      // Security name.	Investment	YIDS Federal Income
    const I	    = "I";      // Price.	Investment	I5.125
    const Q	    = "Q";      // Quantity of shares (or split ratio, if Action is StkSplit).	Investment	Q4,896.201
    const O	    = "O";      // Commission cost (generally found in stock trades)	Investment	O14.95

    // Categories
    const B	    = "B";      // Budgeted amount - may be repeated many times for monthly budgets.	Categories	B85.00

    // Invoices
    const X	    = "X";      // Extended data for Quicken Business. Followed by a second character subcode (see below) followed by content data.	Invoices	XI3
    const XA    = "XA";     // Ship-to address	Invoices	XAATTN: Receiving
    const XI	= "XI";     // Invoice transaction type: 1 for invoice, 3 for payment	Invoices	XI1
    const XE	= "XE";     // Invoice due date	Invoices	XE6/17' 2
    const XC	= "XC";     // Tax account	Invoices	XC[*Sales Tax*]
    const XR	= "XR";     // Tax rate	Invoices	XR7.70
    const XT	= "XT";     // Tax amount	Invoices	XT15.40
    const XS	= "XS";     // Line item description	Invoices	XSRed shoes
    const XN	= "XN";     // Line item category name	Invoices	XNSHOES
    const X_HASH= "X#";     //	Line item quantity	Invoices	X#1
    const X_AMNT= "X$";     //	Line item price per unit (multiply by X# for line item amount)	Invoices	X$150.00
    const XF	= "XF";     // Line item taxable flag	Invoices	XFT
}