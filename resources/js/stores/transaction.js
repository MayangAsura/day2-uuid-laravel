

export default{
    namespaced: true,
    state:{
        transaction: 0,
    },
    mutations : {
        increment: (state, payload)=>{
            state.transaction++
        },
        decrement: (state, payload)=>{
            state.transaction--
        },
    },
    actions : {
    
    }, 
    getters : {
        transaction : state => state.transaction
    }


}