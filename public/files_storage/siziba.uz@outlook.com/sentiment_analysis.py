import streamlit as st 
from textblob import TextBlob



def analysis(data):
    analysis = TextBlob(data)
    # set sentiment
    if analysis.sentiment.polarity > 0:
        return 'positive'
    elif analysis.sentiment.polarity == 0:
        return 'neutral'
    else:
        return 'negative'


text = st.text_input('Enter some text')

st.write(text)
st.write("Sentiment score: ", analysis(text))