<template>
    <div class="container-fluid">
        <b-navbar id="navbar" type="dark" variant="dark" align="center">
            <b-navbar-nav>
                <!-- Navbar dropdowns -->
                <b-nav-item-dropdown text="Reminder" right>
                    <b-dropdown-item href="#">Confirmation</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="Personnel" right>
                    <b-dropdown-item @click.prevent="showPersonnel"
                    >Personnel List
                    </b-dropdown-item>

                    <b-dropdown-item @click.prevent="showSchedule"
                    >Schedule
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="workDone">Work Done</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="Payroll Register" right>
                    <b-dropdown-item href="#">Main Sheet</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="Statistics" right>
                    <b-dropdown-item @click.prevent="showInOut">In/Out</b-dropdown-item>
                    <b-dropdown-item href="#">Log</b-dropdown-item>
                    <b-dropdown-item href="#">Sap Export</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="Accounting" right>
                    <b-dropdown-item @click.prevent="showPaidleave">Paid Leave</b-dropdown-item>
                    <b-dropdown-item @click.prevent="showSickleave">Sick Leave</b-dropdown-item>
                    <b-dropdown-item  @click.prevent="showOvertime">Overtime</b-dropdown-item>
                    <b-dropdown-item @click.prevent="showMso">MSO</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="References" right>
                    <b-dropdown-item @click.prevent="showContracts"
                    >Contract Types
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showDepartments"
                    >Departments
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showEducations"
                    >Education
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showFamily"
                    >Family Status
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showAbsences"
                    >Absences Types
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showPositions"
                    >Positions
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showQualifications"
                    >Qualifications
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showTrainings"
                    >Training
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showHolidays"
                    >Public Holidays
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showSalarydates"
                    >Salary Dates
                    </b-dropdown-item
                    >
                    <b-dropdown-item @click.prevent="showWorktypes"
                    >Work Types
                    </b-dropdown-item
                    >
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="Administrations" right>
                    <b-dropdown-item @click.prevent="showGenerator">Generator</b-dropdown-item>
                    <b-dropdown-item href="#">Configuration</b-dropdown-item>
                    <b-dropdown-item href="#">Messages</b-dropdown-item>
                    <b-dropdown-item href="#">Syncronisation</b-dropdown-item>
                    <b-dropdown-item href="#">Close Database</b-dropdown-item>
                    <b-dropdown-item href="#">Menu</b-dropdown-item>
                    <b-dropdown-item href="#">Levels</b-dropdown-item>
                    <b-dropdown-item href="#">My Profile</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item href="#">Exit</b-nav-item>
            </b-navbar-nav>
        </b-navbar>

        <div>
            <component :is="selectedComponent"></component>
        </div>
    </div>
</template>

<script>
import InOut from "../Statistics/InOut.vue";
import ShowPersonnel from "../Personnel/PersonnelList/ShowPersonnel.vue";
import ShowSchedule from "../Personnel/Schedule/Schedules.vue";

// References component starts here
import ShowAbsences from "../References/Absences/ShowAbsences.vue";
import ShowContracts from "../References/Contracts/ShowContracts.vue";
import ShowDepartments from "../References/Departments/ShowDepartments.vue";
import ShowEducations from "../References/Educations/ShowEducations.vue";
import ShowHolidays from "../References/Holidays/ShowHolidays.vue";
import ShowPositions from "../References/Positions/ShowPositions.vue";
import ShowFamily from "../References/Family/ShowFamily.vue";
import ShowQualifications from "../References/Qualifications/ShowQualifications.vue";
import ShowSalarydates from "../References/SalaryDates/ShowSalarydates.vue";
import ShowTrainings from "../References/Trainings/ShowTrainings.vue";
import ShowWorktypes from "../References/WorkTypes/ShowWorktypes.vue";
import WorkDone from "../Personnel/WorkDone/Workdone.vue";
import ShowMso from "../Accounting/MSO/Mso.vue";
import ShowOvertime from "../Accounting/Overtime/Overtime.vue";
import ShowPaidleave from "../Accounting/PaidLeave/Paidleave.vue";
import ShowSickleave from "../Accounting/SickLeave/Sickleave.vue";
import ShowGenerator from "../Administration/Generator/Generator.vue"


// References component  ends here

export default {
    data() {
        return {
            selectedComponent: "",
        };
    },

    components: {
        showPersonnel: ShowPersonnel,
        showSchedule: ShowSchedule,
        inOut: InOut,
        showAbsences: ShowAbsences,
        showContracts: ShowContracts,
        showDepartments: ShowDepartments,
        showEducations: ShowEducations,
        showFamily: ShowFamily,
        showHolidays: ShowHolidays,
        showPositions: ShowPositions,
        showQualifications: ShowQualifications,
        showSalarydates: ShowSalarydates,
        showTrainings: ShowTrainings,
        showWorktypes: ShowWorktypes,
        workDone: WorkDone,
        showMso: ShowMso,
        showOvertime:  ShowOvertime,
        showPaidleave: ShowPaidleave,
        showSickleave: ShowSickleave,
        showGenerator: ShowGenerator,
    },

    methods: {
        showPersonnel() {
            this.selectedComponent = "showPersonnel";
        },
        showSchedule() {
            this.selectedComponent = "showSchedule";
        },
        showInOut() {
            this.selectedComponent = "inOut";
        },
        showAbsences() {
            this.selectedComponent = "showAbsences";
        },
        showContracts() {
            this.selectedComponent = "showContracts";
        },
        showDepartments() {
            this.selectedComponent = "showDepartments";
        },
        showEducations() {
            this.selectedComponent = "showEducations";
        },
        showFamily() {
            this.selectedComponent = "showFamily";
        },
        showHolidays() {
            this.selectedComponent = "showHolidays";
        },
        showPositions() {
            this.selectedComponent = "showPositions";
        },
        showQualifications() {
            this.selectedComponent = "showQualifications";
        },
        showSalarydates() {
            this.selectedComponent = "showSalarydates";
        },
        showTrainings() {
            this.selectedComponent = "showTrainings";
        },
        showWorktypes() {
            this.selectedComponent = "showWorktypes";
        },
        workDone() {
            this.selectedComponent = "workDone";
        },
        showMso() {
            this.selectedComponent = "showMso";
        },
        showOvertime() {
            this.selectedComponent = "showOvertime";
        },
        showPaidleave() {
            this.selectedComponent = "showPaidleave";
        },
        showSickleave() {
            this.selectedComponent = "showSickleave";
        },

        showGenerator() {
            this.selectedComponent = "showGenerator";
        },
    },
};
</script>

<style scoped>
.navbar {
    max-height: 30px;
    max-width: 100%;
    overflow: visible;
    padding-top: 20;
    padding-bottom: 20;
    text-align: center;
}
</style>
