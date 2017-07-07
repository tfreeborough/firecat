<div class="col-xs-12 col-md-6 section">
    <div class="row">
        <div class="col-xs-12">
            <a class="section-title" name="statuses"><h3>Statuses</h3></a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="block row">
                <div class="col-xs-12">
                    <p>
                        A status is used to quickly identify the state of a given opportunity, both vendors and partners are given access
                        to view the status of an opportunity, including un-associated vendor accounts. Statuses are split into 3 categories:
                    </p>
                    <ul>
                        <li>Associated</li>
                        <li>In Review</li>
                        <li>Accepted</li>
                    </ul>


                    <h4>Associated</h4>
                    <p>
                        An opportunity is considered `Associated` when a vendor account as associated themselves with the opportunity.
                        What this means is that a vendor account has commited themselves to working on that opportunity, please note that
                        any number of vendor accounts may associate with a deal.
                    </p>
                    <p>
                        Associated members are given full access to the opportunity, and <strong>cannot disassociate from the opportunity thereafter.</strong>
                        after the vendor has associated they may use internal messaging, view activity as well as set the opportunity to `In Review`.
                    </p>


                    <h4>In Review</h4>
                    <p>
                        An opportunity should be changed to `In Review` when it is exactly that, in this phase vendors that are associated to the opportunity
                        are given the ability to message the partner account and ask for further clarification/information if the
                        opportunity details are unclear.
                    </p>
                    <p>
                        Vendor accounts in this phase will also be able need to make sure <a href="{{route('docs.opportunities.considerations')}}">Considerations</a>
                        are looked at and completed.
                    </p>


                    <h4>Accepted</h4>
                    <p>
                        When an opportunity is accepted, this means that it has been converted into a Deal Registration, you will see a
                        link appear below the status that will link you through to the Deal page, where you can see a further overview and
                        organisation options such as flagging.
                    </p>
                    <div class="alert alert-info">
                        <p>
                            Please note that `flagging` is not yet available as a feature.
                        </p>
                    </div>
                    <p>
                        Once an opportunity has been accepted, it can no longer be modified and is counted toward statistical information
                        on the vendor account.
                    </p>
                    <p>
                        If there is a problem with the opportunity that cannot be resolved, it may be marked as Not Accepted, in this case it
                        will also become un-editable and all communication with the partner will be locked, Vendors can optionally provide
                        feedback to the partner about why the Opportunity was rejected.
                    </p>
                    <p>
                        Opportunities that have no been accepted will still count towards statistical data such as acceptance rate.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>