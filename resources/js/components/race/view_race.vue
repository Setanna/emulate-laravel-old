<!-- view_race.vue -->
<template>
    <div class="subcomponent" v-if="race.id">
        <!-- Name & Cost -->
        <div v-if="race.name" class="background-tertiary title-card title">
            <p style="padding-left: 5px;"> {{ race.name }}</p>
            <div class="clickable" style="padding-left: 5px; display: flex; align-items: center" v-if="abilities.update"
                 @click="editRace()">
                <edit-icon/>
            </div>

            <p style="margin-left:auto; margin-right:0; padding-right: 5px;"> {{ race["experience_cost"] }} XP </p>
        </div>

        <!-- Types & Book -->
        <div v-if="race.types" class="categories sub-title">
            <!-- Types -->
            <p class="background-tertiary category-card" v-for="type in race.types"> {{ type.name }} </p>


            <!-- Book -->
            <div style="margin-left:auto; margin-right:0; position:relative; display: flex; justify-content: center">
                <p style="align-self: center"> {{ race.book.name }}</p>
            </div>
        </div>

        <!-- description -->
        <div v-if="race.description" class="pb-10">
            <hr>
            <p style="font-weight: bold">Description:</p>
            <p v-html="race.description"></p>
        </div>

        <!-- flavor -->
        <div v-if="race.flavor" class="pb-10">
            <hr>
            <p style="font-weight: bold">Flavor:</p>
            <p v-html="race.flavor"></p>
        </div>

        <!-- System -->
        <div v-if="race.system" class="pb-10">
            <hr>
            <p style="font-weight: bold">System:</p>
            <p v-html="race.system"></p>
        </div>

        <!-- Talents -->
        <div v-if="race.talents" style="padding-top: 6px">
            <div v-if="race.talents.length" class="background-tertiary title-card sub-title">
                <p style="padding-left: 5px;"> Talents </p>
            </div>

            <table v-if="race.talents.length" class="trait-table">
                <tbody>
                <tr v-for="talent in race.talents">
                    <td style="width: 20%; font-weight: bold; padding: 5px;">
                        <router-link :to="{name: 'talent', params: {id: talent.id, genre: this.genre}}" class="no-text-link">
                            {{ talent.name }}
                        </router-link>
                    </td>
                    <td style="width: 80%;" v-html="talent.description"></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import editIcon from '../../icons/edit.vue';

export default {
    props: ['genre', 'race', 'abilities'],
    methods: {
        editRace: function () {
            this.$router.push({name: 'edit_race', params: {id: this.race.id, genre: this.genre}})
        }
    },
    components: {
        editIcon
    }
}
</script>

